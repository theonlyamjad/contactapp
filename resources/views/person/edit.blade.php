<!-- Utilisation du layout principal de l'application -->
<x-app-layout>
    <!-- Définition de l'en-tête de la page -->
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('People') }}
        </h2>
    </x-slot>
    <!-- Contenu principal de la page -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Titre de la section d'édition -->
                    <h3 class="font-semibold text-2xl pb-5 border-b border-gray-200">Edit a Person | {{ $person->firstname }} {{ $person->lastname }}</h3>
                    <!-- Formulaire d'édition -->
                    <form action="{{ route('person.update', $person->id) }}" method="POST" class="space-y-8 pt-6">
                        @csrf
                        @method('PUT')
                        <!-- Grille pour les champs du formulaire -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Champ Prénom -->
                            <div>
                                <label for="firstname" class="block text-sm font-medium text-gray-700">
                                    First Name <span class="text-red-600">*</span>
                                </label>
                                <input type="text" name="firstname" id="firstname" value="{{ old('firstname', $person->firstname) }}" required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 sm:text-sm">
                            </div>
                            <!-- Champ Nom -->
                            <div>
                                <label for="lastname" class="block text-sm font-medium text-gray-700">
                                    Last Name <span class="text-red-600">*</span>
                                </label>
                                <input type="text" name="lastname" id="lastname" value="{{ old('lastname', $person->lastname) }}" required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 sm:text-sm">
                            </div>
                            <!-- Champ Email avec gestion d'erreur -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $person->email) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 sm:text-sm">
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- Champ Téléphone avec gestion d'erreur -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone', $person->phone) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 sm:text-sm">
                                @error('phone')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- Champ Nom de l'entreprise -->
                            <div>
                                <label for="business_name" class="block text-sm font-medium text-gray-700">Business Name</label>
                                <input type="text" name="business_name" id="business_name" value="{{ old('business_name', $person->business_name) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 sm:text-sm">
                            </div>
                            <!-- Sélection de la ville -->
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                                <select name="city" id="city" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 sm:text-sm">
                                    <option value="">Select a city</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->ville }}" {{ old('city', $person->city) == $city->ville ? 'selected' : '' }}>{{ $city->ville }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Sélection de l'activité -->
                            <div>
                                <label for="activity" class="block text-sm font-medium text-gray-700">Activity</label>
                                <select name="activity" id="activity" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 sm:text-sm">
                                    <option value="student" @if(old('activity', $person->activity) == 'student') selected @endif>Student</option>
                                    <option value="teacher" @if(old('activity', $person->activity) == 'teacher') selected @endif>Teacher</option>
                                    <option value="worker" @if(old('activity', $person->activity) == 'worker') selected @endif>Worker</option>
                                </select>
                            </div>
                            <!-- Sélection du genre -->
                            <div>
                                <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                                <select name="gender" id="gender" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 sm:text-sm">
                                    <option value="male" @if(old('gender', $person->gender) == 'male') selected @endif>Male</option>
                                    <option value="female" @if(old('gender', $person->gender) == 'female') selected @endif>Female</option>
                                </select>
                            </div>
                            <!-- Champ Âge -->
                            <div>
                                <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
                                <input type="number" name="age" id="age" value="{{ old('age', $person->age) }}" min="1" max="100"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 sm:text-sm">
                            </div>
                        </div>
                        <!-- Section des tags -->
                        <div class="pt-6">
                            <h4 class="font-semibold text-lg border-b border-gray-200 pb-3">Tags</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 pt-4">
                                @foreach ($tags as $tag)
                                    <div class="flex items-center">
                                        <input type="checkbox" id="tag{{ $tag->id }}" name="tags[]" value="{{ $tag->id }}" @checked(in_array($tag->tag_name, $person->tags->pluck('tag_name')->toArray()))
                                               class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                        <label for="tag{{ $tag->id }}" class="ml-2 block text-sm font-medium text-gray-700">
                                            {{ $tag->tag_name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- Boutons d'action -->
                        <div class="mt-6 flex items-center justify-end gap-x-4">
                            <a class="bg-gray-500 text-white py-2 px-4 rounded-full hover:bg-gray-600 transition" href="{{ route('person.index') }}">Cancel</a>
                            <button class="bg-blue-600 text-white py-2 px-4 rounded-full hover:bg-blue-700 transition" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
