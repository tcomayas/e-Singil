<x-layout>
    <div class="w-full p-3">
        <table class="w-full text-center bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b">Full Name</th>
                    <th class="px-4 py-2 border-b">Product</th>
                    <th class="px-4 py-2 border-b">Category</th>
                    <th class="px-4 py-2 border-b">Quantity</th>
                    <th class="px-4 py-2 border-b">Total Price</th>
                    <th class="px-4 py-2 border-b">Actions</th>
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
                <td class="px-4 py-2 border-b">
                    <div class="flex flex-row justify-between">
                        <form method="POST" action="/pending/{{ $cart->id }}">
                            @csrf
                            <input type="hidden" value="Approve" name="status">
                            <button type="submit">Approve</button>
                        </form>
                        <form method="POST" action="/pending/{{ $cart->id }}" >
                            @csrf
                            <input type="hidden" value="Cancel" name="status">
                            <button>CANCEL</button>
                        </form>
                    </div>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
        </div>
</x-layout>
