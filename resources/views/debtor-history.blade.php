<x-app-layout>
    <style>
        @media (max-width: 640px) {
            table {
                width: 60px;
            }

            th {
                font-size: 10px;
            }

            td {
                font-size: 8px;
            }

            .partial-search {
                width: 120px;
                float: right;
                margin-right: 20px;
                height: 20px;
                margin-bottom: 50px;
            }
        }
    </style>
    <div class="flex gap-2">

        <x-sidebar></x-sidebar>
        <div>
            <div class="partial-search">
                @include('partials._search')
            </div>
            <div class="w-full p-5 shadow-md shadow-gray-400" style="max-height: 60vh; overflow-y: scroll; width: 85vw">
                <div class="overflow-x-auto">
                    <table class="w-full text-center bg-white border border-gray-300">
                        <thead class="bg-gray-500">
                            <tr>
                                <th class="px-2 py-1 border-b sm:px-4 sm:py-2">Full Name</th>
                                <th class="px-2 py-1 border-b sm:px-4 sm:py-2">Product</th>
                                <th class="px-2 py-1 border-b sm:px-4 sm:py-2">Category</th>
                                <th class="px-2 py-1 border-b sm:px-4 sm:py-2">Quantity</th>
                                <th class="px-2 py-1 border-b sm:px-4 sm:py-2">Total Price</th>
                                <th class="px-2 py-1 border-b sm:px-4 sm:py-2">Date</th>
                                <th class="px-2 py-1 border-b sm:px-4 sm:py-2">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $cart)
                                <tr>
                                    <td class="px-2 py-1 border-b sm:px-4 sm:py-2">{{ $cart->user->name }}</td>
                                    <td class="px-2 py-1 border-b sm:px-4 sm:py-2">{{ $cart->listing->product }}</td>
                                    <td class="px-2 py-1 border-b sm:px-4 sm:py-2">{{ $cart->listing->category }}</td>
                                    <td class="px-2 py-1 border-b sm:px-4 sm:py-2">{{ $cart->quantity }}</td>
                                    <td class="px-2 py-1 border-b sm:px-4 sm:py-2">
                                        {{ $cart->listing->price * $cart->quantity }}</td>
                                    <td class="px-2 py-1 border-b sm:px-4 sm:py-2">
                                        {{ $cart->created_at->diffForHumans() }}</td>
                                    <td class="px-2 py-1 border-b sm:px-4 sm:py-2">{{ $cart->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>
