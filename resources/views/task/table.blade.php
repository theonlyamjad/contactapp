<!-- Conteneur principal avec défilement horizontal et marge supérieure -->
<div class="overflow-x-auto mt-6">
    <!-- Table des tâches avec style et ombrage -->
    <table class="min-w-full divide-y divide-gray-200 shadow-md rounded-lg">
        <!-- En-tête de la table -->
        <thead class="bg-gray-300">
            <tr>
                <!-- Colonnes d'en-tête pour Titre, Pour, Statut et Actions -->
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">Task Title</th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">For</th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">Status</th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <!-- Corps de la table -->
        <tbody class="bg-white divide-y divide-gray-200 text-center">
            <!-- Boucle sur toutes les tâches -->
            @foreach ($tasks as $task)
                <!-- Ligne de tâche avec effet de survol -->
                <tr class="hover:bg-gray-100">
                    <!-- Cellule pour le titre de la tâche -->
                    <td class="px-6 py-3 whitespace-nowrap">{{ $task->title }}</td>
                    <!-- Cellule pour l'entité associée (Business ou Person) -->
                    <td class="px-6 py-3 whitespace-nowrap">
                        @if ($task->taskable)
                            <!-- Vérification si la tâche est associée à une entreprise -->
                            @if (str_contains($task->taskable_type, 'Business'))
                                <!-- Lien vers les détails de l'entreprise -->
                                <a href="{{ route('business.show', $task->taskable->id) }}" class="flex items-center justify-center text-blue-500 hover:underline">
                                    <!-- Icône d'entreprise -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                                    </svg>
                                    {{ $task->taskable->business_name }}
                                </a>
                            @else
                                <!-- Lien vers les détails de la personne -->
                                <a href="{{ route('person.show', $task->taskable->id) }}" class="flex items-center justify-center text-blue-500 hover:underline">
                                    <!-- Icône de personne -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                    </svg>
                                    {{ $task->taskable->firstname }} {{ $task->taskable->lastname }}
                                </a>
                            @endif
                        @endif
                    </td>
                    <!-- Cellule pour le statut de la tâche -->
                    <td class="px-6 py-3 whitespace-nowrap @if ($task->status == 'open') text-green-500 @endif">
                        <span class="bg-gray-200 py-2 px-4 rounded-full hover:bg-gray-300 transition">
                            {{ $task->status }}
                        </span>
                    </td>
                    <!-- Cellule pour les actions (marquer comme terminé) -->
                    <td class="px-6 py-3 whitespace-nowrap">
                        @if ($task->status == 'open')
                            <!-- Formulaire pour marquer la tâche comme terminée -->
                            <form action="{{ route('task.complete', $task->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button class="bg-blue-600 text-white py-2 px-4 rounded-full hover:bg-blue-700 transition">Mark as Complete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Pagination des tâches -->
    <div class="mt-4">
        {{ $tasks->links() }}
    </div>
</div>
