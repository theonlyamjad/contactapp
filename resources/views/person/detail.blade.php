<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ $person->firstname }} {{ $person->lastname }}'s Profile
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-8">
                        <div>
                            <h3 class="font-semibold text-lg pb-5 mb-5 border-b border-gray-200  flex items-center">
                                Person Details
                                <a href="{{ route('person.generatePdf', $person->id) }}" class="bg-gray-400 text-white py-1 px-2 rounded-full ml-auto flex items-center hover:bg-black"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="size-6 m-1 ">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                                    </svg>
                                </a>
                            </h3>
                            <dl>
                                <div class="grid grid-cols-1 gap-y-2">
                                    <div class="flex items-center">
                                        <dt class="font-semibold pr-2">Name:</dt>
                                        <dd>{{ $person->firstname }} {{ $person->lastname }}</dd>
                                    </div>
                                    <div class="flex items-center">
                                        <dt class="font-semibold pr-2">Phone:</dt>
                                        <dd>{{ $person->phone }}</dd>
                                    </div>
                                    <div class="flex items-center">
                                        <dt class="font-semibold pr-2">Email:</dt>
                                        <dd>{{ $person->email }}</dd>
                                    </div>
                                    <div class="flex items-center">
                                        <dt class="font-semibold pr-2">City:</dt>
                                        <dd>{{ $person->city }}</dd>
                                    </div>
                                    <div class="flex items-center">
                                        <dt class="font-semibold pr-2">Activity:</dt>
                                        <dd>{{ $person->activity }}</dd>
                                    </div>
                                    <div class="flex items-center">
                                        <dt class="font-semibold pr-2">Gender:</dt>
                                        <dd>{{ $person->gender }}</dd>
                                    </div>
                                    <div class="flex items-center">
                                        <dt class="font-semibold pr-2">Age:</dt>
                                        <dd>{{ $person->age }}</dd>
                                    </div>
                                    <div class="flex items-center">
                                        <dt class="font-semibold pr-2">Tags:</dt>
                                        <dd class="flex flex-wrap">
                                            @foreach ($person->tags as $tag)
                                                <span class="bg-green-600 text-white text-xs px-2 py-1 rounded-full mr-2 mb-2">{{ $tag->tag_name }}</span>
                                            @endforeach
                                        </dd>
                                    </div>
                                </div>
                            </dl>
                            <div class="mt-6">
                                <a class="bg-blue-600 text-white py-2 px-4 rounded-full inline-block" href="{{ route('person.edit', $person->id) }}">Edit Person</a>
                            </div>
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg pb-5 mb-5 border-b border-gray-200">Create a new Task</h3>
                            <form action="{{ route('task.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="taskable_id" value="{{ $person->id }}">
                                <input type="hidden" name="target_model" value="person">
                                <div class="grid grid-cols-1 gap-y-4">
                                    <div>
                                        <label class="block font-semibold" for="title">Task title</label>
                                        <input class="block w-full border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" type="text" name="title" id="title" value="{{ old('title') }}">
                                    </div>
                                    <div>
                                        <label class="block font-semibold" for="description">Task description</label>
                                        <textarea class="block w-full border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" type="text" name="description" id="description">{{ old('description') }}</textarea>
                                    </div>
                                    <div class="flex items-center justify-end">
                                        <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-full">Create Task</button>
                                    </div>
                                </div>
                            </form>
                            <h3 class="font-semibold text-lg pb-5 border-b border-gray-200">Tasks</h3>
                                <!-- Vérification de l'existence des tâches pour cette personne -->
                            @if ($person->tasks && $person->tasks->count() > 0)
                            <!-- Boucle sur les tâches, triées par date de création et statut -->
                            @foreach ($person->tasks->sortBy('created_at')->sortByDesc('status') as $task)
                                <div class="border-t border-gray-200 py-4">
                                    <h4 class="font-semibold">{{ $task->title }}</h4>
                                    <p>{{ $task->description }}</p>
                                    <!-- Affichage conditionnel basé sur le statut de la tâche -->
                                    @if ($task->status == "open")
                                        <div class="pt-3">
                                            <!-- Formulaire pour marquer la tâche comme terminée -->
                                            <form action="{{ route('task.complete', $task->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button class="bg-blue-600 text-white py-2 px-4 rounded-full" type="submit">Complete Task</button>
                                            </form>
                                        </div>
                                    @else
                                        <div class="text-green-600">Completed</div>
                                    @endif
                                </div>
                            @endforeach
                            @else
                                <!-- Message affiché s'il n'y a pas de tâches pour cette personne -->
                                <p colspan="8" class="px-4 py-2 whitespace-nowrap text-sm text-red-700 text-center bg-red-100">No tasks available for this person.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
