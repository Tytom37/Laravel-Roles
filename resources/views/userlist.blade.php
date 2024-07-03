<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-6 px-4">
        <div class="flex justify-end mb-4">
            <form action="{{ route('users.download-excel') }}" method="POST" target="_blank">
                @csrf
                <button type="submit" class="font-bold bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700 transition duration-300">
                    Export Excel
                </button>
            </form>
        </div>
        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Password</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($users as $user)
                    <tr>
                        <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-900">{{ $user->id }}</td>
                        <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-900">{{ $user->name }}</td>
                        <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-900">{{ $user->email }}</td>
                        <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-900">{{ $user->password }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
