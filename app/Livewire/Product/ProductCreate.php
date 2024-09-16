<?php

namespace App\Livewire\Product;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class ProductCreate extends Component
{
    // Importar el trait WithFileUploads
    use WithFileUploads;

    // Definir las reglas de validación
    #[Validate('required|string|max:50')]
    public $name = '';

    #[Validate('required|string')]
    public $description = '';

    #[Validate('required|numeric|min:0')]
    public $price;

    #[Validate('nullable|image|max:1024')]
    public $image;

    #[Validate('required|exists:categories,id')]
    public $category_id;

    public $categories;

    public function mount()
    {
        // Cargar las categorías 
        $this->categories = Category::all(); 
    }

    public function save()
    {
        $this->validate(); // Validar automáticamente las propiedades con #[Validate]

        // Subir imagen si existe
        if ($this->image) {
            $imagePath = $this->image->store('images', 'public'); // Guardar la imagen
        }

        // Crear el producto en la base de datos
        Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'image' => $imagePath ?? null,
            'category_id' => $this->category_id,
        ]);

        // Mostrar mensaje de éxito
        session()->flash('status', 'Producto creado... .'); 

        // Redirige a la lista de productos
        return $this->redirect(route('products.index'));
    }

    #[Layout('layouts.product')]
    public function render()
    {
        return view('livewire.product.product-create');
    }
}
