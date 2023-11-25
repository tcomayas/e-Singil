    <x-layout>

        <div class="w-full p-3">
            @include('partials._search')
            <table class="w-full mt-5 text-center bg-white border border-gray-300">
                <thead class="bg-gray-500">
                    <tr>
                        <th class="px-4 py-2 border-b">ID</th>
                        <th class="px-4 py-2 border-b">Full Name</th>
                        <th class="px-4 py-2 border-b">Product</th>
                        <th class="px-4 py-2 border-b">Category</th>
                        <th class="px-4 py-2 border-b">Quantity</th>
                        <th class="px-4 py-2 border-b">Price</th>
                        <th class="px-4 py-2 border-b">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carts as $cart)
                        <tr>
                            <td class="px-4 py-2 border-b">{{ $cart->id }}</td>
                            <td class="px-4 py-2 border-b">{{ $cart->user->name }}</td>
                            <td class="px-4 py-2 border-b">{{ $cart->listing->product }}</td>
                            <td class="px-4 py-2 border-b">{{ $cart->listing->category }}</td>
                            <td class="px-4 py-2 border-b">{{ $cart->quantity }}</td>
                            <td class="px-4 py-2 border-b">{{ $cart->listing->price * $cart->quantity }}</td>
                            <td class="px-4 py-2 border-b">{{ $cart->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-layout>
