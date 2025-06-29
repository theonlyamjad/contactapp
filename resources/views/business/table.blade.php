<div class="overflow-x-auto mt-6">
    <table class="min-w-full divide-y divide-gray-200 shadow-md rounded-lg">
        <thead class="bg-gray-300">
            <tr>
                <th scope="col" class="px-4 py-2 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">Business Name</th>
                <th scope="col" class="px-4 py-2 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">Contact Email</th>
                <th scope="col" class="px-4 py-2 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">Category</th>
                <th scope="col" class="px-4 py-2 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">City</th>
                <th scope="col" class="px-4 py-2 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">Tags</th>
                <th scope="col" class="px-4 py-2 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($businesses as $business)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-2 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    <a href="{{ route('business.show', $business->id) }}" class="text-blue-600 hover:underline">
                                        {{ $business->business_name }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $business->contact_email }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $business->category }}</td>

                    <td class="px-4 py-2 whitespace-nowrap">{{ $business->city->ville ?? ''  }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">
                        <div class="flex flex-wrap">
                            @foreach ($business->tags as $tag)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-lime-600 text-white mr-2 mb-2">
                                    {{ $tag->tag_name }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('business.edit', $business->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        <form action="{{ route('businessdestroy', $business->id) }}" method="POST" style="display:inline;">
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
