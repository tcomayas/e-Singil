    <x-layout :notifs='$notifs'>
        <div class="w-full p-3">
            <div>
                <form action="/debt">
                    @csrf
                    <div class="flex justify-end">
                        <div class="relative flex mt-4 mb-4 border-2 border-gray-100 rounded-lg w-100">
                            <div class="relative mx-2 top-4">
                                <i class="z-20 text-gray-400 fa fa-search hover:text-gray-500"></i>
                            </div>
                            <input type="text" name="search"
                                class="z-0 w-full pr-20 rounded-lg h-14 focus:shadow focus:outline-none"
                                placeholder="Search Product..." />
                            <div class="absolute top-2 right-2">
                                <button type="submit"
                                    class="w-20 h-10 text-black bg-blue-300 rounded-lg hover:bg-green-600 opacity-90">
                                    Search
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
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
