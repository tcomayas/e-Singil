<x-layout :notifs='$notifs'>
    <table class="table w-full mt-4 text-center border border-collapse border-gray-300">
        <thead>
            <tr>
                <th class="bg-gray-300 border border-black">Sale No.</th>
                <th class="bg-gray-300 border border-black">Item Name</th>
                <th class="bg-gray-300 border border-black">Quantity</th>
                <th class="bg-gray-300 border border-black">Amount</th>
                <th class="bg-gray-300 border border-black">Description</th>
                <th class="bg-gray-300 border border-black">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $sale)
                <tr>
                    <td class="border border-black">{{ $sale->id }}</td>
                    <td class="border border-black">{{ $sale->listing->product }}</td>
                    <td class="border border-black">{{ $sale->quantity }}</td>
                    <td class="border border-black">₱{{ $sale->amount }}</td>
                    <td class="border border-black">{{ $sale->description }}</td>
                    <td class="border border-black">{{ $sale->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>
