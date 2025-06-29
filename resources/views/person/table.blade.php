<div class="mt-6">
    <table class="min-w-full divide-y divide-gray-200 shadow-md rounded-lg table-fixed">
        <thead class="bg-gray-300">
            <tr>
                <th scope="col" class="w-1/8 px-4 py-2 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">Name</th>
                <th scope="col" class="w-1/8 px-4 py-2 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">Email</th>
                <th scope="col" class="w-1/8 px-4 py-2 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">Phone</th>
                <th scope="col" class="w-1/8 px-4 py-2 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">Business</th>
                <th scope="col" class="w-1/8 px-4 py-2 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">City</th>
                <th scope="col" class="w-1/8 px-4 py-2 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">Activity</th>
                <th scope="col" class="w-1/8 px-4 py-2 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">Tags</th>
                <th scope="col" class="w-1/8 px-4 py-2 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody id="person-table-body" class="bg-white divide-y divide-gray-200">
            @forelse ($persons as $person)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-2 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                @if ($person->gender == 'male')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 2a4 4 0 1 0 0 8 4 4 0 0 0 0-8z" clip-rule="evenodd"/>
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-pink-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 2a4 4 0 1 0 0 8 4 4 0 0 0 0-8z" clip-rule="evenodd"/>
                                    </svg>
                                @endif
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    <a href="{{ route('person.show', $person->id) }}" class="text-blue-600 hover:underline">{{ $person->firstname }} {{ $person->lastname }}</a>
                                    <span class="ml-2 text-base text-gray-500">{{ $person->age }}</span>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $person->email }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $person->phone }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $person->business_name }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $person->city }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $person->activity }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">
                        <div class="flex flex-wrap">
                            @foreach ($person->tags as $tag)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-lime-600 text-white mr-2 mb-2">
                                    {{ $tag->tag_name }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('person.edit', $person->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        <form action="{{ route('person.destroy', $person->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="px-4 py-2 whitespace-nowrap text-sm text-red-700 text-center bg-red-100">
                        Oops! Nothing matches our data.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
