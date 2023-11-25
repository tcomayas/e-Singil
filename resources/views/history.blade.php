<x-layout>
    @include('partials._search')

    <div class="w-full p-5" style="max-height: 60vh; overflow-y: scroll; width: 85vw">
        <table class="w-full text-center bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b">Full Name</th>
                    <th class="px-4 py-2 border-b">Product</th>
                    <th class="px-4 py-2 border-b">Category</th>
                    <th class="px-4 py-2 border-b">Quantity</th>
                    <th class="px-4 py-2 border-b">Total Price</th>
                    <th class="px-4 py-2 border-b">Date</th>
                    <th class="px-4 py-2 border-b">Status</th>
                </tr>
            </thead>
            <tbody>
    @foreach ($carts as $cart)
            <tr>
                <td class="px-4 py-2 border-b">{{ $cart->user->name }}</td>
                <td class="px-4 py-2 border-b">{{ $cart->listing->product }}</td>
                <td class="px-4 py-2 border-b">{{ $cart->listing->category }}</td>
                <td class="px-4 py-2 border-b">{{ $cart->quantity }}</td>
                <td class="px-4 py-2 border-b">{{ $cart->listing->price * $cart->quantity }}</td>
                <td class="px-4 py-2 border-b">{{ $cart->created_at->diffForHumans() }}</td>
                <td class="px-4 py-2 border-b">{{ $cart->status }}</td>
            </tr>

            @endforeach
        </tbody>
    </table>
        </div>
</x-layout>
