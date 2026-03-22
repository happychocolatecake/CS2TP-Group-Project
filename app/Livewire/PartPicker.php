<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class PartPicker extends Component
{
    public array $categories = [
        'cpu' => ['label' => 'CPU', 'db_name' => 'CPU'],
        'motherboard' => ['label' => 'Motherboard', 'db_name' => 'Motherboard'],
        'ram' => ['label' => 'Memory (RAM)', 'db_name' => 'RAM'],
        'gpu' => ['label' => 'Graphics Card', 'db_name' => 'GPU'],
        'ssd' => ['label' => 'Storage (SSD)', 'db_name' => 'SSD'],
        'psu' => ['label' => 'Power Supply', 'db_name' => 'PSU'],
        'case' => ['label' => 'PC Case', 'db_name' => 'Case'],
        'fan' => ['label' => 'Cooling Fan', 'db_name' => 'Cooling Fan'],
    ];

    public array $selected = [];
    public $activeCategory = null;

    public function selectCategory($key)
    {
        $this->activeCategory = ($this->activeCategory === $key) ? null : $key;
    }

    public function selectPart($categoryKey, $productId)
    {
        // Eager load specs so we can check compatibility later
        $product = Product::with('specs')->find($productId);

        // Map specs into an easy key-value array (e.g., ['socket' => 'AM5'])
        $specs = $product->specs->pluck('spec_value', 'spec_key')->toArray();

        $this->selected[$categoryKey] = [
            'id' => $product->id,
            'name' => $product->product_name,
            'price' => $product->product_price,
            'image' => $product->product_image,
            'specs' => $specs, // Store specs in the session array
        ];

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

    private function applyCompatibilityFilters(Builder $query, $category)
    {
        // 1. CPU & Motherboard Socket Compatibility
        if ($category === 'cpu' && isset($this->selected['motherboard'])) {
            $socket = $this->selected['motherboard']['specs']['socket'] ?? null;
            if ($socket) {
                $query->whereHas('specs', fn($q) => $q->where('spec_key', 'socket')->where('spec_value', $socket));
            }
        }

        if ($category === 'motherboard' && isset($this->selected['cpu'])) {
            $socket = $this->selected['cpu']['specs']['socket'] ?? null;
            if ($socket) {
                $query->whereHas('specs', fn($q) => $q->where('spec_key', 'socket')->where('spec_value', $socket));
            }
        }

        // 2. RAM & Motherboard Memory Type Compatibility
        if ($category === 'ram' && isset($this->selected['motherboard'])) {
            $memoryType = $this->selected['motherboard']['specs']['memory_type'] ?? null;
            if ($memoryType) {
                $query->whereHas('specs', fn($q) => $q->where('spec_key', 'memory_type')->where('spec_value', $memoryType));
            }
        }

        if ($category === 'motherboard' && isset($this->selected['ram'])) {
            $memoryType = $this->selected['ram']['specs']['memory_type'] ?? null;
            if ($memoryType) {
                $query->whereHas('specs', fn($q) => $q->where('spec_key', 'memory_type')->where('spec_value', $memoryType));
            }
        }

        // 3. Motherboard & Case Form Factor Compatibility
        if ($category === 'case' && isset($this->selected['motherboard'])) {
            $formFactor = $this->selected['motherboard']['specs']['form_factor'] ?? null;
            if ($formFactor) {
                // Assuming Case spec 'supported_form_factors' holds values like "ATX, Micro-ATX"
                $query->whereHas('specs', fn($q) => $q->where('spec_key', 'supported_form_factors')->where('spec_value', 'LIKE', '%' . $formFactor . '%'));
            }
        }

        return $query;
    }

    public function render()
    {
        $categoryProducts = [];

        if ($this->activeCategory) {
            $dbCategoryName = $this->categories[$this->activeCategory]['db_name'];

            // Start query and eager load specs
            $query = Product::where('product_part', $dbCategoryName)->with('specs');

            // Apply our compatibility logic to filter out incompatible parts
            $query = $this->applyCompatibilityFilters($query, $this->activeCategory);

            $categoryProducts = $query->get();
        }

        return view('livewire.part-picker', ['availableProducts' => $categoryProducts]);
    }
}
