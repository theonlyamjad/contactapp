<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-center text-green-500 mb-6">Contact's Details</h1>
    <table class="w-full border-collapse">
        <tr class="border-b">
            <th class="text-left p-4 bg-gray-100">Name</th>
            <td class="p-4">{{ $firstname }} {{ $lastname }}</td>
        </tr>
        <tr class="border-b">
            <th class="text-left p-4 bg-gray-100">Age</th>
            <td class="p-4">{{ $age }}</td>
        </tr>
        <tr class="border-b">
            <th class="text-left p-4 bg-gray-100">Gender</th>
            <td class="p-4">{{ $gender }}</td>
        </tr>
        <tr class="border-b">
            <th class="text-left p-4 bg-gray-100">Email</th>
            <td class="p-4">{{ $email }}</td>
        </tr>
        <tr class="border-b">
            <th class="text-left p-4 bg-gray-100">Phone</th>
            <td class="p-4">{{ $phone }}</td>
        </tr>
        <tr class="border-b">
            <th class="text-left p-4 bg-gray-100">Business Name</th>
            <td class="p-4">{{ $business_name }}</td>
        </tr>
        <tr class="border-b">
            <th class="text-left p-4 bg-gray-100">City</th>
            <td class="p-4">{{ $city }}</td>
        </tr>
        <tr class="border-b">
            <th class="text-left p-4 bg-gray-100">Activity</th>
            <td class="p-4">{{ $activity }}</td>
        </tr>
    </table>
</div>
