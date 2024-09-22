<x-app-layout>
    <x-slot name="header">
            <span class="font-semibold text-md text-gray-800 leading-tight">{{ __('Main') }}</span>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @foreach ($categories as $category)
        <a href="{{ route('categories.show', $category->id) }}" class="block mb-4">
            <div class="mx-6 p-4 bg-white shadow rounded-lg">
                <div class="max-w-xl flex justify-between items-center">
                    <!-- Item Name on the left -->
                    <span class="text-md">{{ $category->name }}</span>
        
                    <!-- Item Stock on the right -->
                    <span class="text-gray-600">{{ $category->items->count() }}</span>
                </div>
            </div>
        </a>
        @endforeach
        </div>
        <div class="mx-6 p-4 text-sm">
                Click <a href="{{ route('categories.create')}}">here</a> to add new category
        </div>
    </div>
</x-app-layout>
