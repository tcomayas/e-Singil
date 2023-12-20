<x-app-layout>
    <div class="flex gap-5">
        <x-sidebar></x-sidebar>
        <div>
            <div class="flex flex-row flex-wrap justify-center w-1/4 gap-5">
                @if (count($carts) === 0)
                    <p class="mt-5 text-center" style="font-size: 25px;">No Items found!</p>
                @else
                    @foreach ($carts as $cart)
                        <x-card class="mt-4 h-30 w-60">
                            <h3 class="text-center">{{ $cart->id }}</h3>
                            <div class="flex flex-row items-center gap-4 p-5 text-center">
                                <div>
                                    <h3 class="font-bold text-start ">Item:</h3>
                                    <h3 class="font-bold text-start ">Quantity:</h3>
                                    <h3 class="font-bold text-start ">Total Price: </h3>
                                    <h3 class="font-bold text-start ">Time: </h3>
                                </div>
                                <div class="text-start">
                                    <p>{{ $cart->listing->product }}</p>
                                    <p>{{ $cart->quantity }} pc/s</p>
                                    <p>₱{{ $cart->listing->price * $cart->quantity }}</p>
                                    <p>{{ $cart->created_at->diffForHumans() }}</p>
                                </div>
                                <form method="POST" action="/pending/{{ $cart->id }}">
                                    @csrf
                                    <input type="hidden" value="Cancel" name="status">
                                    <button class="p-2 bg-red-400 rounded">CANCEL</button>
                                </form>
                            </div>
                        </x-card>
                    @endforeach
                @endif
                <x-flash-message></x-flash-message>
            </div>
        </div>
    </div>
</x-app-layout>
