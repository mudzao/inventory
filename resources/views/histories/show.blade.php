<x-app-layout>
    <x-slot name="header">
            <a class="font-semibold text-md text-gray-800 leading-tight" href="{{route('home')}}">{{ __('Main') }}</a> / Stock Update History
    </x-slot>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
            <div class="mx-6 p-2 bg-white shadow rounded-lg mb-6">
                <select id="history-filter" class="border border-transparent rounded p-2 w-full focus:border-transparent focus:ring-0">
                    <option value="today" {{ request('filter') === 'today' ? 'selected' : '' }}>
                        Today
                    </option>
                    <option value="week" {{ request('filter') === 'week' ? 'selected' : '' }}>
                        This Week
                    </option>
                    <option value="month" {{ request('filter') === 'month' ? 'selected' : '' }}>
                        This Month
                    </option>
                </select>
            </div>            

            <div class="mx-6 p-4 bg-white shadow rounded-lg">
                <div class="space-y-2">
                        @foreach($histories as $history)
                            <div class="flex justify-between items-center py-2">
                                <!-- Date and Time (e.g., 'Saturday, 17/9/2024 2:00PM') -->
                                <span class="text-gray-700 text-sm">
                                    <a href="{{ route('items.show', $history->item->id) }}" class="text-gray-700">
                                    {{ $history->created_at->setTimezone('Asia/Kuala_Lumpur')->format('d/n/y') }} : {{ $history->item->name }}
                                    </a>
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
                            {{ $histories->appends(request()->query())->links() }}
                        </div>
                </div>
            </div>
        </div>       
    </div>

    <script>
        document.getElementById('history-filter').addEventListener('change', function () {
            const filter = this.value;
            window.location.href = `?filter=${filter}`;
        });
    </script>
</x-app-layout>
