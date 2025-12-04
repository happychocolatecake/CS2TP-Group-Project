<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;

class Store extends Component
{
    public $search = '';
    public $selectedCategories = [];
    public $minPrice;
    public $maxPrice;
    public $categories;

    public function mount() {

        $this->categories = Category::all();
        $this->minPrice = Product::min('product_price');
        $this->maxPrice = Product::max('product_price');
    }

    public function toggleCategory($categoryId) {
        if (!in_array($categoryId, $this->selectedCategories)) {
            $this->selectedCategories[] = $categoryId;
        }
        else {
            $this->selectedCategories = array_diff($this->selectedCategories, [$categoryId]);
        }
    }

    public function render()
    {
        //split up filters and use queries
        $query = Product::query();

        if (!empty($this->search)){
            $query->where(function ($q) {
            $q->where('product_name', 'like', '%' . $this->search . '%')
                ->orWhere('product_description', 'like', '%' . $this->search . '%');
            });

        }

        if (!empty($this->selectedCategories)) {
             $query->whereIn('category_id', $this->selectedCategories);
        }

        if (!empty($this->minPrice) && !empty($this->maxPrice)) {
            $query->whereBetween('product_price', [$this->minPrice, $this->maxPrice]);
        }

        return view('livewire.store', [
            'products' => $query->get(),
        ]);
    }
}
