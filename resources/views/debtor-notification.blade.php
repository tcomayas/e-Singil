<x-app-layout>
    <div class="flex flex-row gap-2">
        <x-sidebar></x-sidebar>
        <div class="w-full mt-5">
            <table class="w-full text-center bg-white border border-gray-300" style="width: 100% !important;">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border-b">ID</th>
                        <th class="px-4 py-2 border-b">Message</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notif as $nots)
                        <tr>
                            <td class="px-4 py-2 border-b">{{ $nots->id }}</td>
                            <td class="px-4 py-2 border-b">{{ $nots->message }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
