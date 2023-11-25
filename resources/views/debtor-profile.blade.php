<x-layout>
    <div class="flex flex-col gap-5 mt-5">
        @include('partials._search')
        <div class="flex flex-row flex-wrap justify-center gap-5">
            @foreach ($users as $user)
                <a href="{{ route('debtorpayment', ['debtorId' => $user->id]) }}">
                    <x-card class="flex flex-row justify-center gap-2">
                        <div class="p-5 text-center shadow-md border-gray">
                            <img src="{{ asset('storage/images/' . $user->photo) }}" alt="Photo" class="w-full mx-auto"
                                style="width: 250px; height: 250px;">
                            <h3 class="text-lg font-bold">{{ $user->name }}</h3>
                            <p>{{ $user->address }}</p>
                            <p class="font-bold">{{ $user->email }}</p>
                            <p class="font-bold">DEBT: @if (count($user->total_debt) == 0)
                                    0
                                @else
                                    {{ $user->total_debt[0]->totaldebt }}
                                @endif
                            </p>
                        </div>
                    </x-card>
                </a>
            @endforeach
        </div>
    </div>
</x-layout>
