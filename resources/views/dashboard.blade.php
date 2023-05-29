<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="p-8 flex h-full w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('search-github-user')
            </div>
        </div>
        
        <div class="bg-white shadow-lg rounded-lg w-full min-h-full p-8">
            @livewire('manage-github-user-repositories')
        </div>

    </div>
</x-app-layout>
