<x-app-layout>
    <x-slot name="header">
         <a class="font-semibold text-md text-gray-800 leading-tight" href="{{ route('home') }}">Main / </a>{{ $category->name }}
    </x-slot>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
            @foreach ($items as $item)
            <a href="{{ route('items.show', $item->id) }}" class="block mb-4">
                <div class="mx-6 p-4 bg-white shadow rounded-lg">
                    <div class="max-w-xl flex justify-between items-center">
                        <!-- Item Name on the left -->
                        <span class="text-md {{ $item->stock <= $item->reorder_qty ? 'text-red-600' : '' }}">
                            {{ $item->name }}
                        </span>
            
                        <!-- Item Stock on the right -->
                        <span class="text-gray-600 {{ $item->stock <= $item->reorder_qty ? 'text-red-600' : '' }}">
                            {{ $item->stock }}
                        </span>
                    </div>
                </div>
            </a>
            @endforeach
                       
        </div>


    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mx-6 p-4 sm:p-8 bg-white shadow rounded-lg">
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Add New Item') }}
            </h2>
    
            <p class="mt-1 text-sm text-gray-600 mb-6">
                {{ __("Add new item name and initial stock amount") }}
            </p>
        <form action="{{ route('items.store') }}" method="POST">
        @csrf
            <!-- Name Input -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input wire:model="form.name" id="name" class="block mt-1 w-full" type="text" name="name" required autocomplete="name" />
            </div>

            <!-- Stock Input (Number) -->
            <div class="mt-4">
                <x-input-label for="stock" :value="__('Initial Stock')" />
                <x-text-input id="stock" class="block mt-1 w-full" type="number" name="stock" required />
            </div>

            <!-- Reorder Input (Number) -->
            <div class="mt-4">
                <x-input-label for="reorder_qty" :value="__('Re-order Quantity')" />
                <x-text-input id="reorder_qty" class="block mt-1 w-full" type="number" name="reorder_qty" required />
            </div>
            
            <!-- Hidden Category ID Input -->
            <input type="hidden" name="category_id" value="{{ $category->id }}">

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-3">
                    {{ __('Add New Item') }}
                </x-primary-button>
            </div>
        </form>
        </div>
        <div class="mx-6 p-4 text-sm">
            Click <a href="{{ route('categories.edit', $category->id) }}">here</a> to edit this category
        </div>
    </div>
</x-app-layout>
