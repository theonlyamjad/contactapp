<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ $business->business_name }}'s Company
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-8">
                        <div>
                            <h3 class="font-semibold text-lg pb-5 mb-5 border-b border-gray-200  flex items-center">
                                Business Details
                                <a href="http://127.0.0.1:8000/business/{{ $business->id }}/show/generate-pdf" class="bg-gray-400 py-1 px-2 rounded-full ml-auto flex items-center hover:bg-black hover:text-white" style="transition: background-color 0.1s;">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="size-6 m-1 hover:text-white">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                                    </svg>
                                </a>


                            </h3>
                            <dl>
                                <div class="grid grid-cols-1 gap-y-2">
                                    <div class="flex items-center">
                                        <dt class="font-semibold pr-2">Name:</dt>
                                        <dd>{{ $business->business_name }}</dd>
                                    </div>
                                    <div class="flex items-center">
                                        <dt class="font-semibold pr-2">Contact Email:</dt>
                                        <dd>{{ $business->contact_email }}</dd>
                                    </div>
                                    <div class="flex items-center">
                                        <dt class="font-semibold pr-2">City:</dt>
                                        <dd>{{ $business->city->ville }}</dd>
                                    </div>
                                    <div class="flex items-center">
                                        <dt class="font-semibold pr-2">Category:</dt>
                                        <dd>{{ $business->category }}</dd>
                                    </div>
                                    <div class="flex items-center">
                                        <dt class="font-semibold pr-2">Website:</dt>
                                        <dd>{{ $business->website }}</dd>
                                    </div>
                                    <div class="flex items-center">
                                        <dt class="font-semibold pr-2">Location:</dt>
                                        <dd>{{ $business->location }}</dd>
                                    </div>
                                </div>
                            </dl>
                            <div class="mt-6">
                                <a class="bg-blue-600 text-white py-2 px-4 rounded-full hover:bg-blue-700 transition" href="{{ route('business.edit', $business->id) }}">Edit Business</a>
                            </div>
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg pb-5 mb-5 border-b border-gray-200">Create a new Task</h3>
                            <form action="{{ route('task.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="taskable_id" value="{{ $business->id }}">
                                <input type="hidden" name="target_model" value="business">
                                <div class="grid grid-cols-1 gap-y-4">
                                    <div>
                                        <label class="block font-semibold" for="title">Task Title</label>
                                        <input class="block w-full border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" type="text" name="title" id="title" value="{{ old('title') }}">
                                    </div>
                                    <div>
                                        <label class="block font-semibold" for="description">Task Description</label>
                                        <textarea class="block w-full border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" name="description" id="description">{{ old('description') }}</textarea>
                                    </div>
                                    <div class="flex items-center justify-end">
                                        <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-full hover:bg-blue-700 transition">Create Task</button>
                                    </div>
                                </div>
                            </form>
                            <h3 class="font-semibold text-lg pt-5">Tasks</h3>
                            <hr class="border-t border-gray-200 mb-4">
                                <!-- Vérifie si l'entreprise a des tâches -->
                            @if ($business->tasks && $business->tasks->count() > 0)
                                <!-- Boucle sur les tâches, triées par statut puis par date de création (descendant) -->
                                @foreach ($business->tasks->sortBy('status')->sortByDesc('created_at') as $task)
                                    <!-- Conteneur pour chaque tâche -->
                                    <div class="border-t border-gray-200 py-4">
                                        <!-- Titre de la tâche -->
                                        <h4 class="font-semibold">{{ $task->title }}</h4>
                                        <!-- Description de la tâche -->
                                        <p>{{ $task->description }}</p>
                                        <!-- Vérifie si la tâche est ouverte ou complétée -->
                                        @if ($task->status == "open")
                                            <!-- Affiche un bouton pour marquer la tâche comme complétée si elle est ouverte -->
                                            <div class="pt-3">
                                                <form action="{{ route('task.complete', $task->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="bg-blue-600 text-white py-2 px-4 rounded-full hover:bg-blue-700 transition" type="submit">Mark as Complete</button>
                                                </form>
                                            </div>
                                        @else
                                            <!-- Affiche un message indiquant que la tâche est complétée -->
                                            <div class="text-green-600">Completed</div>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <!-- Message affiché s'il n'y a pas de tâches pour cette entreprise -->
                                <p colspan="8" class="px-4 py-2 whitespace-nowrap text-sm text-red-700 text-center bg-red-100">No tasks available for this business.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
