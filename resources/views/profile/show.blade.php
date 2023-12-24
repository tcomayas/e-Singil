<style scoped>
    .user-card img {
        widows: 250px;
        height: 250px;
    }

    #separator {
        display: flex;
    }

    @media screen and (max-width: 1024px) {
        #separator {
            display: flex;
            flex-direction: column;
        }

        .user-card {
            height: 300px;
        }

        .user-card img {
            height: 200px;
            width: 200px;
        }

        #totalDebt {
            margin-left: 40px;
            margin-top: 30px;
        }
    }

    @media (max-width: 640px) {
        #username {
            font-size: 15px;
        }

        p {
            font-size: 12px;
        }
    }
</style>

<x-app-layout>
    <div class="flex gap-2">
        <x-sidebar></x-sidebar>
        <div class="flex flex-row gap-2" id="separator">
            <div class="grid grid-col col">
                <div class="user-card">

                    <div class="p-5 mt-5 text-center border shadow-md user-card border-gray">
                        <img src="{{ asset('storage/images/' . $user->photo) }}" alt="Photo" class="w-full mx-auto">
                        <div class="flex flex-row gap-4 mt-5 ">
                            <div class="font-bold text-start">
                                <h3>Name:</h3>
                                <h3>Address:</h3>
                                <h3>Phone:</h3>
                                <h3>Email:</h3>
                            </div>
                            <div class="text-start">
                                <h3 class="text-lg font-bold" id="username">{{ $user->name }}</h3>
                                <p>{{ $user->address }}</p>
                                <p>{{ $user->phone }}</p>
                                <p class="font-bold">{{ $user->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <x-card class="p-3 text-center" id="totalDebt">
                        <h4>Total Debt</h4>
                        <p class="font-bold">DEBT: @if (count($user->total_debt) != 0)
                                @if ($user->total_debt[count($user->total_debt) - 1]->status == 'Complete')
                                    0
                                @else
                                    {{ $user->total_debt[count($user->total_debt) - 1]->totaldebt }}
                                @endif
                            @endif
                        </p>


                    </x-card>
                </div>
            </div>

            <div class="mt-5 shadow-md shadow-gray-400" style="max-height: 81.5vh; overflow-y: scroll; width: 66vw">
                @if (count($carts) === 0)
                    <h2 class="mx-5 mt-10 font-bold">You have no current debt!</h2>
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
