<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white">
            {{ __('Tasks') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center justify-center space-x-4">
                        <form action="{{ route('task.index') }}" method="GET" class="relative w-full max-w-xl">
                            <input type="text" name="contact_search" class="border border-gray-300 px-8 p-1 w-full text-lg rounded-md focus:ring focus:border-blue-300" placeholder="Search by Contact's Name" value="{{ request('contact_search') }}"/>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute top-1/2 transform -translate-y-1/2 right-3 h-6 w-6 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </form>
                    </div>
                    @include('task.table')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
