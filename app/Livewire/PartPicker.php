<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class PartPicker extends Component
{
    //individually giving each product part a label and linking it to the database
    public array $categories = [
        'cpu' => [
            'label' => 'CPU',
            'db_name' => 'CPU'
        ],
        'motherboard' => [
            'label' => 'Motherboard',
            'db_name' => 'Motherboard'
        ],
        'ram' => [
            'label' => 'Memory (RAM)',
            'db_name' => 'RAM'
        ],
        'gpu' => [
            'label' => 'Graphics Card',
            'db_name' => 'GPU'
        ],
        'ssd' => [
            'label' => 'Storage (SSD)',
            'db_name' => 'SSD'
        ],
        'psu' => [
            'label' => 'Power Supply',
            'db_name' => 'PSU'
        ],
        'case' => [
            'label' => 'PC Case',
            'db_name' => 'Case'
        ],
        'fan' => [
            'label' => 'Cooling Fan',
            'db_name' => 'Cooling Fan'
        ],
    ];

    public array $selected = [];
    //we will use an array to track which category is being selected
    public $activeCategory = null;

    public function selectCategory($key)
    {
        // creates a toggle for selecting a particular category
        $this->activeCategory = ($this->activeCategory === $key) ? null : $key;
    }

    public function selectPart($categoryKey, $productId)
    {
        $product = Product::find($productId);

            $this->selected[$categoryKey] = [
            'id' => $product->id,
            'name' => $product->product_name,
            'price' => $product->product_price,
            'image' => $product->product_image,
        ];

        //after selecting a part for the category the category should close
        $this->activeCategory = null;
    }

    public function removePart($category)
    {
        unset($this->selected[$category]);
    }

    public function getTotalProperty()
    {
        return array_sum(array_column($this->selected, 'price'));
    }

    public function render()
    {
        //obtain products only for the selected category using an array
        $categoryProducts = [];
        if ($this->activeCategory) {
            $dbCategoryName = $this->categories[$this->activeCategory]['db_name'];
            $categoryProducts = Product::where('product_part', $dbCategoryName)->get();
        }
        return view('livewire.part-picker', [ 'availableProducts' => $categoryProducts]);
    }
}
