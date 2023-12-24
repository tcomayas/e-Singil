    <x-layout :notifs='$notifs'>
        <div class="w-full p-3">

            {{-- <div style="max-height: 400px; overflow-y: scroll; border-bottom: 1px solid gray;">
                <table class="table w-full mt-5 text-center bg-white border border-gray-300" id="stickyTable">
                    <thead class="bg-gray-100" style="position: fixed;">
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
            </div> --}}
            <div style="border-bottom: 1px solid gray;">
                <table class="table w-full mt-5 text-center bg-white border border-gray-300" id="stickyTable">
                    <thead class="bg-gray-100" style="position: sticky; top: 0;">
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
                    <tbody style="max-height: 400px; overflow-y: scroll;">
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


            <script>
                var stickyTable = document.getElementById('stickyTable');
                new Stickybits(stickyTable, {
                    stickyBitStickyOffset: 1
                });
            </script>

        </div>
    </x-layout>
