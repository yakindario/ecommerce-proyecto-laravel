<?php

namespace App\Livewire\Product;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\Product;

class ProductsIndex extends Component
{
    use WithPagination;

    // Eliminar producto 
    public function deleteProduct($productId)
    {
        $product = Product::find($productId);
        if ($product) {
            $product->delete();
            session()->flash('status', 'Post successfully updated.');
        }
    }

    public function editProduct($productId)
    {
        return redirect()->route('products.update', $productId);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $products = Product::paginate(10);
        return view(
            'livewire.product.products-index',
            ['products' => $products]
        );
    }
}
