<div class="flex flex-col md:flex-row items-start md:items-center justify-between border-2 bg-gray-100 border-gray-300 p-4 rounded-md relative"><!-- Conteneur principal pour les filtres -->
    <form method="GET" action="{{ route('person.index') }}" class="flex flex-col md:flex-row w-full">  <!-- Formulaire de filtrage -->
        <!-- Filtre pour le genre -->
        <div class="mb-4 md:mb-0 md:mr-4">
            <label for="sex" class="block text-gray-700 font-bold mb-2">Gender</label>
            <select id="sex" name="sex" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <!-- Marque l'option comme sélectionnée si elle correspond à l'activité actuelle-->
                <option value="both" {{ request('sex') == 'both' ? 'selected' : '' }}>Both</option>
                <option value="male" {{ request('sex') == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ request('sex') == 'female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>
        <!-- Filtre pour la ville -->
        <div class="mb-4 md:mb-0 md:mr-4">
            <label for="city" class="block text-gray-700 font-bold mb-2">City</label>
            <select id="city" name="city" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Select a city</option>
                @foreach($cities as $city)
                    <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>{{ $city }}</option>
                @endforeach
            </select>
        </div>
        <!-- Filtre pour l'âge -->
        <div class="mb-4 md:mb-0 md:mr-4">
            <label for="age" class="block text-gray-700 font-bold mb-2">Age</label>
            <input type="number" id="age" name="age" value="{{ request('age') }}" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" min="1" max="100">
        </div>
        <!-- Filtre pour l'activité -->
        <div class="mb-4 md:mb-0 md:mr-4">
            <label for="activity" class="block text-gray-700 font-bold mb-2">Activity</label>
            <select name="activity" id="activity" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 sm:text-sm">
                <option value="">Select an activity</option>
                <!-- Marque l'option comme sélectionnée si elle correspond à l'activité actuelle-->
                <option value="student" {{ request('activity') == 'student' ? 'selected' : '' }}>Student</option>
                <option value="teacher" {{ request('activity') == 'teacher' ? 'selected' : '' }}>Teacher</option>
                <option value="worker" {{ request('activity') == 'worker' ? 'selected' : '' }}>Worker</option>
            </select>
        </div>
        <!-- Boutons pour réinitialiser et appliquer les filtres -->
        <div class="flex items-center md:items-end space-x-4">
            <button type="button" id="resetFilters" class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded-full">Reset</button>
            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full">Apply Filters</button>
        </div>
    </form>
</div>
<script>
    // Fonction pour réinitialiser tous les filtres
    const resetFilters = document.getElementById('resetFilters');
    resetFilters.addEventListener('click', () => {
        document.getElementById('sex').value = 'both';
        document.getElementById('city').value = '';
        document.getElementById('age').value = '';
        document.getElementById('activity').value = '';
    });
    // Fonction pour afficher/masquer les filtres avancés
    const toggleFilters = document.getElementById('toggleFilters');
    const advancedFilters = document.getElementById('advancedFilters');
    const buttonText = document.getElementById('buttonText');
    toggleFilters.addEventListener('click', () => {
        advancedFilters.classList.toggle('hidden');
        buttonText.textContent = advancedFilters.classList.contains('hidden') ? '+ Advanced Filters' : '- Fewer Filters';
    });
</script>
