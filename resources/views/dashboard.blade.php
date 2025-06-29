<x-app-layout>
    <div class="h-screen flex flex-col bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800">
        <header class="bg-white dark:bg-gray-800 shadow-md flex-shrink-0">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Dashboard
                </h1>
            </div>
        </header>
        <main class="flex-1 overflow-hidden">
            <div class="h-full overflow-hidden px-4 sm:px-6 lg:px-8 py-6">
                <div class="max-w-7xl mx-auto">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
                            {{ $greeting }} <span class="text-indigo-600 dark:text-indigo-400">{{ $user->name }}</span>
                        </h2>
                    </div>
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                        <!-- People Card -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl border-dashed border border-gray-300 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">People</h3>
                            <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <div class="text-4xl font-bold text-indigo-600 dark:text-indigo-400 mb-6">{{ $totalPersons }}</div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-indigo-100 border-blue-600 dark:bg-indigo-900/50 rounded-xl p-4 transition duration-300 transform hover:scale-105 shadow-lg shadow-indigo-500/50 dark:shadow-lg dark:shadow-indigo-800/80">
                                <p class="text-sm font-medium text-indigo-800 dark:text-indigo-200 mb-1">Male</p>
                                <p class="text-2xl font-semibold text-indigo-600 dark:text-indigo-300">{{ $totalMales }}</p>
                            </div>
                            <div class="bg-pink-100 dark:bg-pink-900/50 rounded-xl p-4 transition duration-300 transform hover:scale-105 shadow-lg shadow-pink-500/50 dark:shadow-lg dark:shadow-pink-800/80">
                                <p class="text-sm font-medium text-pink-800 dark:text-pink-200 mb-1">Female</p>
                                <p class="text-2xl font-semibold text-pink-600 dark:text-pink-300">{{ $totalFemales }}</p>
                            </div>

                        </div>
                    </div>
                    <div class=" dark:bg-gray-700/50 px-6 py-4">
                        <div class="flex items-end mb-2 h-24">
                            <div class="w-1/2 bg-indigo-400  rounded-t-md transition-all duration-500 mr-1" style="height: {{ $totalPersons > 0 ? ($totalMales / $totalPersons) * 100 : 0 }}%;"></div>
                            <div class="w-1/2 bg-pink-400 rounded-t-md transition-all duration-500 ml-1" style="height: {{ $totalPersons > 0 ? ($totalFemales / $totalPersons) * 100 : 0 }}%;"></div>
                        </div>
                        <div class="flex text-xs text-gray-500 dark:text-gray-400 mt-2">
                            <div class="w-1/2 text-center">Male</div>
                            <div class="w-1/2 text-center">Female</div>
                        </div>
                    </div>
                </div>
                <!-- Business Card -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl border-dashed border border-gray-300 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Business</h3>
                            <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <div class="text-4xl font-bold text-green-600 dark:text-green-400 mb-6">{{ $totalBusiness }}</div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-3">Top 5 Cities:</p>

                        <div class="space-y-2">
                            @foreach($topBusinessCities as $city)
                                <div class="flex justify-between items-center bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3 transition duration-300 hover:bg-gray-700 hover:text-gray-100 dark:hover:bg-gray-600">
                                    <span class="text-sm font-medium">{{ $city->ville }}</span>
                                    <span class="text-sm font-bold">{{ $city->businesses_count }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Tasks Card -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl border-dashed border border-gray-300 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Tasks Completed</h3>
                            <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                        </div>
                        <div class="text-4xl font-bold text-purple-600 dark:text-purple-400 mb-6">{{ $totalTaskDone }}</div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-purple-100 dark:bg-purple-900/50 rounded-xl p-4 transition duration-300 transform hover:scale-105 shadow-lg shadow-purple-500/50 dark:shadow-lg dark:shadow-purple-800/80">
                                <p class="text-sm font-medium text-purple-800 dark:text-purple-200 mb-1">By People</p>
                                <p class="text-2xl font-semibold text-purple-600 dark:text-purple-300">{{ $totalTasksDoneByPeople }}</p>
                            </div>
                            <div class="bg-yellow-100 dark:bg-yellow-900/50 rounded-xl p-4 transition duration-300 transform hover:scale-105 shadow-lg shadow-yellow-500/50 dark:shadow-lg dark:shadow-yellow-800/80">
                                <p class="text-sm font-medium text-yellow-800 dark:text-yellow-200 mb-1">By Business</p>
                                <p class="text-2xl font-semibold text-yellow-600 dark:text-yellow-300">{{ $totalTasksDoneByBusiness }}</p>
                            </div>

                        </div>
                    </div>
                    <div class=" dark:bg-gray-700/50 px-6 py-4">
                        <div class="flex items-end mb-2 h-24">
                            <div class="w-1/2 bg-purple-400 dark:bg-purple-500 rounded-t-md transition-all duration-500 mr-1" style="height: {{ $totalTaskDone > 0 ? ($totalTasksDoneByPeople / $totalTaskDone) * 100 : 0 }}%;"></div>
                            <div class="w-1/2 bg-yellow-400 dark:bg-yellow-500 rounded-t-md transition-all duration-500 ml-1" style="height: {{ $totalTaskDone > 0 ? ($totalTasksDoneByBusiness / $totalTaskDone) * 100 : 0 }}%;"></div>
                        </div>
                        <div class="flex text-xs text-gray-500 dark:text-gray-400 mt-2">
                            <div class="w-1/2 text-center">By People</div>
                            <div class="w-1/2 text-center">By Business</div>
                        </div>
                    </div>
                </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
