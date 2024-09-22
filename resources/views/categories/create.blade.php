<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Category') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="mx-6 p-4 sm:p-8 bg-white shadow rounded-lg">
            <form action="{{ route('categories.store') }}" method="POST">
            @csrf
        <!-- Email Address -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input wire:model="form.name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
            </div>
            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-3">
                    {{ __('Create') }}
                </x-primary-button>
            </div>
            </form>
            </div>
        </div>
    </div>
</x-app-layout>
