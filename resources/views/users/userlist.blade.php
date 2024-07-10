<x-app-layout>
    <div class="container mx-auto py-6 px-4">
        <div class="flex justify-end mb-4">
            <form action="{{ route('users.download-excel') }}" method="POST" target="_blank">
                @csrf
                <div class="flex gap-2">
                    @can('create user')
                        <a href="{{ route('user.create') }}" class="font-bold bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700 transition duration-300">Create User</a>
                    @endcan
                        {{-- <button type="submit" class="font-bold bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-300">
                        Export Excel
                    </button> --}}
                </div>
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
                        <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($users as $user)
                    <tr>
                        <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-900">{{ $user->id }}</td>
                        <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-900">{{ $user->name }}</td>
                        <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-900">{{ $user->email }}</td>
                        <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-900">{{ $user->password }}</td>
                        <td>
                            @can('edit user')
                                <a href="{{ route('user.edit', $user) }}" class="py-2 px-6 whitespace-nowrap text-sm text-gray-900 bg-green-200 rounded">Edit</a>
                            @endcan
                            @can('delete user')
                                <form action="{{ route('user.destroy', $user) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="py-1.5 px-4 whitespace-nowrap text-sm text-gray-900 bg-red-200 rounded">Delete</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
