<x-app-layout>
    @can('visit logs')
        <div class="container mx-auto py-6 px-4">
            <div class="p-5">
                <h1 class="text-2xl font-bold mb-4 text-white">Activity Log</h1>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="bg-gray-200 text-black-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Timestamp (Created At - Updated At)</th>
                            <th class="py-3 px-6 text-left">Log Entry</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($logs as $log)
                        <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                            <td class="py-3 px-6 text-left">{{ $log->created_at }} - {{ $log->updated_at }}</td>
                            <td class="py-3 px-6 text-left">{{ $log->log_entry }} - {{ $log->user->name }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endcan
</x-app-layout>
