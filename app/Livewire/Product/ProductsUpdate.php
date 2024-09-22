<?php

namespace App\Livewire\Product;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use App\Models\Product;
use App\Models\Category;

class ProductsUpdate extends Component
{
    use WithFileUploads;

    public $product = [];
    public $categories = [];
    public $image;

    // Cargar datos del producto $Id
    public function mount($id)
    {
        $product = Product::find($id);

        $this->product = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'description' => $product->description,
            'image' => $product->image,
            'category_id' => $product->category_id,
        ];
        $this->categories = Category::all();
    }

    // Update product
    public function updateProduct()
    {
        $this->validate([
            'product.name' => 'required|string|max:255',
            'product.price' => 'required|numeric',
            'product.description' => 'nullable|string',
            'product.category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:1024',
        ]);

        $product = Product::find($this->product['id']);

        if ($this->image) {
            $product->image = $this->image->store('images', 'public');
        }

        $product->update([
            'name' => $this->product['name'],
            'price' => $this->product['price'],
            'description' => $this->product['description'],
            'category_id' => $this->product['category_id'],
        ]);

        // Mostrar mensaje de éxito
        session()->flash('status', 'Producto creado... .'); 
        // Redirige a la lista de productos
        return $this->redirect(route('products.index'));
    }

    #[Layout('layouts.product')]
    public function render()
    {
        return view('livewire.product.products-update');
    }
}
