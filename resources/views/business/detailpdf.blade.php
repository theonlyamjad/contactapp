<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-center text-green-500 mb-6">Contact's Details</h1>
    <table class="w-full border-collapse">
        <tr class="border-b">
            <th class="text-left p-4 bg-gray-100">Business Name</th>
            <td class="p-4">{{ $Business_Name }}</td>
        </tr>
        <tr class="border-b">
            <th class="text-left p-4 bg-gray-100">Contact Email</th>
            <td class="p-4">{{ $Contact_Email }}</td>
        </tr>
        <tr class="border-b">
            <th class="text-left p-4 bg-gray-100">Category</th>
            <td class="p-4">{{ $Category }}</td>
        </tr>
        <tr class="border-b">
            <th class="text-left p-4 bg-gray-100">Website</th>
            <td class="p-4">{{ $Website }}</td>
        </tr>
        <tr class="border-b">
            <th class="text-left p-4 bg-gray-100">City</th>
            <td class="p-4">{{ $City }}</td>
        </tr>
        <tr class="border-b">
            <th class="text-left p-4 bg-gray-100">Location</th>
            <td class="p-4">{{ $Location }}</td>
        </tr>
    </table>
</div>
