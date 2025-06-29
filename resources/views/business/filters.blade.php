<div class="flex flex-col md:flex-row items-start md:items-center justify-between border-2 bg-gray-100 border-gray-300 p-4 rounded-md relative">
    <form method="GET" action="{{ route('business.index') }}" class="flex flex-col md:flex-row w-full">
        <div class="mb-4 md:mb-0 md:mr-4">
            <label for="category" class="block text-gray-700 font-bold mb-2">Category</label>
            <select name="category" id="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 sm:text-sm">
                <option value="" >Select Category</option>
                <option value="Technology" {{ request('category') == 'Technology' ? 'selected' : '' }}>Technology</option>
                <option value="Food" {{ request('category') == 'Food' ? 'selected' : '' }}>Food</option>
                <option value="Retail" {{ request('category') == 'Retail' ? 'selected' : '' }}>Retail</option>
                <option value="Finance" {{ request('category') == 'Finance' ? 'selected' : '' }}>Finance</option>
            </select>
        </div>
        <div class="mb-4 md:mb-0 md:mr-4">
            <label for="city" class="block text-gray-700 font-bold mb-2">City</label>
            <select id="city" name="city" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="" >Select a city</option>
                @foreach($cities as $city)
                    <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>{{ $city }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex items-center md:items-end">
            <button type="button" id="resetFilters" class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded-full mr-2">Reset</button>
            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full">Submit</button>
        </div>
    </form>
</div>
<script>
    // Fonction pour réinitialiser tous les filtres
    const resetFilters = document.getElementById('resetFilters');//const est un mot-clé utilisé pour déclarer une constante
    resetFilters.addEventListener('click', () => {
        document.getElementById('category').value = '';
        document.getElementById('city').value = '';
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

