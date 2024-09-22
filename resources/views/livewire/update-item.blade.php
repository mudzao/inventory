<?php

use Livewire\Volt\Component;
use App\Models\Item;

new class extends Component
{
    public Item $item;
    public int $stock;
    public int $initialStock;

    public function mount(Item $item)
    {
        $this->item = $item;
        $this->stock = $item->stock;
        $this->initialStock = $item->stock; // Track the initial stock
    }

    public function incrementStock()
    {
        $this->stock++;
    }

    public function decrementStock()
    {
        if ($this->stock > 0) {
            $this->stock--;
        }
    }

    public function updateStock()
    {
        // Get the initial stock value before the update
        $initialStock = $this->item->stock;

        // Calculate the difference in stock
        $stockDifference = $this->stock - $initialStock;

        // If there's no stock difference, don't write to history and just return
        if ($stockDifference === 0) {
            return redirect()->route('categories.show', $this->item->category_id);
        }

        // Determine whether the change is 'in' or 'out'
        $changeType = $stockDifference > 0 ? 'in' : 'out';

        // Update the stock of the item
        $this->item->update(['stock' => $this->stock]);

        // Add a new history record, including the updated stock count
        \App\Models\History::create([
            'item_id'        => $this->item->id,
            'change'         => $changeType,
            'quantity'       => abs($stockDifference), // Always store as a positive quantity
            'stock_at_change' => $this->stock, // Store the stock count after the update
            'description'    => $changeType == 'in' ? 'Stock increased' : 'Stock decreased',
        ]);

        // Redirect to the category's show page after updating the stock
        return redirect()->route('categories.show', $this->item->category_id);
    }
};
?>

<section>
    <div class="max-w-xl flex justify-between items-center p-4">
        <!-- Minus Button with text, in red if decreasing -->
        <button wire:click="decrementStock" class="text-4xl font-semibold rounded-lg text-red-600">
            -{{ $initialStock - $stock > 0 ? abs($initialStock - $stock) : '' }}
        </button>
    
        <!-- Stock Quantity -->
        <h1 class="text-4xl font-bold">{{ $stock }}</h1>
    
        <!-- Plus Button with text, in green if increasing -->
        <button wire:click="incrementStock" class="text-4xl font-semibold rounded-lg text-green-600">
            +{{ $stock - $initialStock > 0 ? abs($stock - $initialStock) : '' }}
        </button>
    </div>
    
    <!-- Update Button -->
    <div>
        <x-primary-button wire:click="updateStock" class="w-full flex justify-center items-center">
            <span>Update Stock</span>
        </x-primary-button>
    </div>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="mt-2 text-green-600">
            {{ session('message') }}
        </div>
    @endif
</section>