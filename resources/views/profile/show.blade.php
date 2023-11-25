<x-app-layout>
    <div class="flex gap-2">
        <x-sidebar></x-sidebar>
        <div class="flex flex-row gap-2">
            <div class="grid grid-col col">
                <div class="">
                    <div class="p-5 mt-5 text-center border shadow-md user-card border-gray">
                        <img src="{{ asset('storage/images/' . $user->photo) }}" alt="Photo" class="w-full mx-auto"
                            style="width: 250px; height: 250px;">
                        <h3 class="text-lg font-bold">{{ $user->name }}</h3>
                        <p>{{ $user->address }}</p>
                        <p class="font-bold">{{ $user->email }}</p>
                    </div>
                </div>

                <div>
                    <x-card class="p-3 text-center ">
                        <h4>Total Debt</h4>
                        @if (count($user->total_debt) != 0)
                            <p class="font-bold">{{ $user->total_debt[0]->totaldebt }}</p>
                        @else
                            <p class="font-bold">0</p>
                        @endif


                    </x-card>
                </div>
            </div>

            <div class="flex flex-1 mt-5 shadow-md shadow-gray-400"
                style="max-height: 81.5vh; overflow-y: scroll; width: 66vw">
                @if (count($carts) === 0)
                    <h2 class="mx-auto mt-10 font-bold">You have no current debt!</h2>
                @else
                    <table class="w-full text-center bg-white border border-gray-300 ">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border-b">ID</th>
                                <th class="px-4 py-2 border-b">Product</th>
                                <th class="px-4 py-2 border-b">Category</th>
                                <th class="px-4 py-2 border-b">Quantity</th>
                                <th class="px-4 py-2 border-b">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $cart)
                                <tr>
                                    <td class="px-4 py-2 border-b">{{ $cart->id }}</td>
                                    <td class="px-4 py-2 border-b">{{ $cart->listing->product }}</td>
                                    <td class="px-4 py-2 border-b">{{ $cart->listing->category }}</td>
                                    <td class="px-4 py-2 border-b">{{ $cart->quantity }}</td>
                                    <td class="px-4 py-2 border-b">{{ $cart->listing->price * $cart->quantity }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
