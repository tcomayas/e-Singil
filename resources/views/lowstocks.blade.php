<x-layout :notifs='$notifs'>
    <table class="table w-full mt-4 text-center border border-collapse border-gray-300">
        <thead>
            <tr>
                <th class="bg-gray-300 border border-black">Sale No.</th>
                <th class="bg-gray-300 border border-black">Item Name</th>
                <th class="bg-gray-300 border border-black">Quantity</th>
                <th class="bg-gray-300 border border-black">Description</th>
                <th class="bg-gray-300 border border-black">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listings as $list)
                @if ($list->quantity <= 5)
                    <tr>
                        <td class="border border-black">{{ $list->id }}</td>
                        <td class="border border-black">{{ $list->product }}</td>
                        <td class="border border-black">{{ $list->quantity }}</td>
                        <td class="border border-black">{{ $list->description }}</td>
                        <td class="border border-black">{{ $list->created_at }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</x-layout>
