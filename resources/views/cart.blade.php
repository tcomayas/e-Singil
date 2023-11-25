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
                            <div class="flex flex-col items-center p-5 text-center">
                                <div>
                                    <p class="mb-4 text-xl font-bold">{{ $cart->listing->product }}</p>
                                    <p class="mb-4 text-xl font-bold">{{ $cart->listing->category }}</p>
                                    <p class="mb-4 text-xl font-bold">{{ $cart->quantity }}</p>
                                    <p class="mb-4 text-xl font-bold">{{ $cart->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </x-card>
                    @endforeach
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
