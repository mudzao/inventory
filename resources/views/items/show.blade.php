<x-app-layout>
    <x-slot name="header">
         <a class="font-semibold text-md text-gray-800 leading-tight" href="{{ route('home') }}">Main / </a><a class="font-semibold text-md text-gray-800 leading-tight" href="{{ route('categories.show', $item->category->id) }}">{{ $item->category->name }}</a> / {{ $item->name}}
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="mx-6 p-4 bg-white shadow rounded-lg">
                    <livewire:update-item :item="$item" />
                </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
            <div class="mx-6 p-4 bg-white shadow rounded-lg">
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Stock Update History') }}
                </h2>

                <div class="mt-4 space-y-2">
                    @if($histories->isEmpty())
                    <p class="text-gray-600">No stock update history available.</p>
                    @else
                        @foreach($histories as $history)
                            <div class="flex justify-between items-center py-2">
                                <!-- Date and Time (e.g., 'Saturday, 17/9/2024 2:00PM') -->
                                <span class="text-gray-700 text-sm">
                                    {{ $history->created_at->setTimezone('Asia/Kuala_Lumpur')->format('D, d/n/y g:i A') }}
                                </span>
                            
                                <!-- Stock Change Indicator and Stock at Change -->
                                <span class="text-sm font-bold {{ $history->change == 'in' ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $history->change == 'in' ? '+' : '-' }}{{ $history->quantity }} ({{ $history->stock_at_change }})
                                </span>
                            </div>
                        
            
                            <!-- Divider -->
                            @if (!$loop->last)
                                <hr class="border-t border-gray-300">
                            @endif
                        @endforeach
            
                        <!-- Pagination Links -->
                        <div class="mt-4">
                            {{ $histories->links() }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="mx-6 p-4 text-sm">
                Click <a href="{{ route('items.edit', $item->id) }}">here</a> to edit this item
            </div>
    </div>
    </div>
</x-app-layout>
