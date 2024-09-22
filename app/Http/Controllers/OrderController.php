<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;
use Illuminate\Support\Facades\Cache;

class OrderController extends Controller
{
    public function index()
    {
        // Recuperar el carrito y el total desde la sesión
        $cart = session('cart', []);
        $totalPrice = session('total', 0.0); // Cambiado a 'total'
        $itemCount = session('item_count', 0);
        $address = Auth::user()->address;
        $user = Auth::user();

        // Validar que haya algo en el carrito
        if (empty($cart)) {
            dd('No hay productos en el carrito');
        }

        // Mostrar la vista de checkout con los datos del carrito
        return view('orders.checkout', [
            'cart' => $cart,
            'totalPrice' => $totalPrice,
            'itemCount' => $itemCount,
            'address' => $address,
            'user' => $user,
        ]);
    }

    public function store(Request $request)
    {

        // Crear la orden
        $order = Order::create($request->except('_token') + ['user_id' => auth()->user()->id]);

        // Obtener el contenido del carrito y crear los detalles de la orden
        $items = collect(session('cart', []))->map(function ($item) use ($order) {
            $orderDetail = OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);

            return [
                'id' => "PROD-{$orderDetail->id}",
                'name' => $orderDetail->product->id,
                'quantity' => $item['quantity'],
                'unit_price' => (float) $orderDetail->price,
            ];
        })->values()->toArray();

        // Configurar Mercado Pago
        MercadoPagoConfig::setAccessToken(config('services.mercado_pago.token'));
        MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);

        $client = new PreferenceClient;

        try {
            $preference = $client->create([
                'items' => $items,
                'auto_return' => 'approved',
                'back_urls' => [
                    'success' => route('config', ['order' => $order]),
                    'failure' => route('config', ['order' => $order]),
                    'pending' => route('config', ['order' => $order]),
                ],
                'statement_descriptor' => 'Mi Tienda',
            ]);

            // Actualizar la orden con el ID de la preferencia
            $order->update(['preference' => $preference->id]);

            return redirect($preference->init_point);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function callback(Order $order, Request $request)
    {
        if ($order->preference == $request->preference_id) {
            $order->update(['api_response' => $request->all()]);
            
            // Limpiar la sesión o la caché del carrito
            session()->forget(['cart', 'total', 'item_count']);
            Cache::forget('cart');
        }

        return redirect('/')->with('success', 'Se acredito el pago');
    }
}
