<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white">
            {{ __('People') }}
        </h2>
    </x-slot>
    <div class="py-10 ">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center justify-center flex-grow">
                            <form action="{{ route('person.index') }}" method="GET" class="relative w-full max-w-xl">
                                <input type="text" name="search" class="border border-gray-300 px-8 p-1 w-full text-lg rounded-md focus:ring focus:border-blue-300" placeholder="Looking for someone?" value="{{ request('search') }}"/>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute top-1/2 transform -translate-y-1/2 right-3 h-6 w-6 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                </svg>
                            </form>
                        </div>
                        <button id="toggleFilters" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline ml-4">
                            <span id="buttonText">+ Advanced Filters</span>
                        </button>
                        <div class="ml-4">
                            <a class="bg-blue-500 text-white py-2 px-3 rounded-full hover:bg-blue-700" href="{{ route('person.create') }}">Add Person</a>
                        </div>
                        <div class="ml-4">
                            <a class="bg-purple-500 text-white py-2 px-3 rounded-full hover:bg-purple-700" href="{{ route('person.export') }}">Export</a>
                        </div>
                        <div class="ml-4">
                            <form action="{{ route('person.import') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="file" accept=".csv" class="hidden" id="csvFile" onchange="this.form.submit()">
                                <label for="csvFile" class="bg-red-500 text-white py-2 px-3 rounded-full hover:bg-red-700 cursor-pointer">Import </label>
                            </form>
                        </div>
                    </div>
                    <div id="advancedFilters" class="{{ request()->hasAny(['sex', 'city', 'age', 'activity']) ? '' : 'hidden' }} mb-4">
                        @include('person.filters')
                    </div>
                    @include('person.table')
                    <div class="mt-6">
                        {{ $persons->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
