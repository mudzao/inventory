<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Item') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mx-6 p-4 sm:p-8 bg-white shadow rounded-lg">
            <form action="{{ route('items.store') }}" method="POST">
            @csrf
                <!-- Name Input -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input wire:model="form.name" id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name', $item->name) }}"  required autocomplete="name" />
                </div>
    
                <!-- Stock Input (Number) -->
                <div class="mt-4">
                    <x-input-label for="stock" :value="__('Stock')" />
                    <x-text-input id="stock" class="block mt-1 w-full" type="number" value="{{ old('stock', $item->stock) }}" name="stock" required />
                </div>
    
                <!-- Reorder Input (Number) -->
                <div class="mt-4">
                    <x-input-label for="reorder_qty" :value="__('Re-order Quantity')" />
                    <x-text-input id="reorder_qty" class="block mt-1 w-full" type="number" value="{{ old('reorder_qty', $item->reorder_qty) }}" name="reorder_qty" required />
                </div>
                
                <!-- Hidden Category ID Input -->
                <input type="hidden" name="category_id" value="{{ $item->category->id }}">
    
                <div class="flex items-center justify-end mt-4">
                    <a href="{{ route('items.show', $item->id) }}" class="btn btn-secondary">Cancel</a> <!-- Link back to the item's detail page -->

                    <x-primary-button class="ms-3">
                        {{ __('Update Item') }}
                    </x-primary-button>
                </div>
            </form>
            </div>
            <div class="mx-6 p-4 text-sm">
                <form action="{{ route('items.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                    @csrf
                    @method('DELETE') <!-- Laravel requires the DELETE method for deletions -->
            
                    Click <button type="submit" class="btn btn-danger">here</button> to delete this item
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
