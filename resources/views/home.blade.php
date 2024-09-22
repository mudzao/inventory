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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
            <div class="mx-6 p-4 bg-white shadow rounded-lg">
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Low Stock Items') }}
                </h2>

                <div class="mt-4 space-y-2">
                    @if($lowitems->isEmpty())
                    <p class="text-gray-600">No low stock items.</p>
                    @else
                        @foreach($lowitems as $item)
                        <div class="flex justify-between items-center py-2">
                            <!-- Category and Item Name, wrapped in an anchor tag -->
                            <a href="{{ route('items.show', $item->id) }}" class="text-gray-700">
                                {{ $item->name }}
                            </a>
                        
                            <!-- Stock Quantity -->
                            <span class="font-bold text-red-600">
                                {{ $item->stock }}
                            </span>
                        </div>
                    
                        <!-- Divider -->
                        @if (!$loop->last)
                            <hr class="border-t border-gray-300">
                        @endif
                        @endforeach                
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
