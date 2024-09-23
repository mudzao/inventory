<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Category') }}
        </h2>
    </x-slot>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
            <div class="mx-6 p-4 sm:p-8 bg-white shadow rounded-lg">
            <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <!-- Email Address -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input wire:model="form.name" id="name" value="{{ old('name', $category->name) }}" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
            </div>
            <div class="flex items-center justify-end mt-4">

                <a href="{{ route('categories.show', $category->id) }}" class="btn btn-secondary">Cancel</a> <!-- Link back to the item's detail page -->

                <x-primary-button class="ms-3">
                    {{ __('Update Category') }}
                </x-primary-button>
            </div>
            </form>
            </div>
            <div class="mx-6 text-sm">
                @if($category->items()->count() > 0)
                <!-- If the category has items, show a message that it cannot be deleted -->
                <p class="text-danger">Cannot delete category with active items.</p>
            @else
                <!-- If the category has no items, show the delete button -->
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
                    @csrf
                    @method('DELETE') <!-- Laravel requires the DELETE method for deletions -->
            
                    Click <button type="submit" class="btn btn-danger">here</button> to delete this category
                </form>
            @endif
            </div>
        </div>
    </div>
</x-app-layout>
