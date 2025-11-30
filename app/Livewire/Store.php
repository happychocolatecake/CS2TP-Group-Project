<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class Store extends Component
{
    public $search = '';

    public function render()
    {
        return view('livewire.store', [
            'products' => Product::where('product_name', 'like', '%' . $this->search . '%')
                ->orWhere('product_description', 'like', '%' . $this->search . '%')
                ->get()
        ]);
    }
}
