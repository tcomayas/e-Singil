<x-layout>

    <div>
        @include('partials._search')
        <div class="flex justify-around w-full gap-20">
            @if (auth()->user() && auth()->user()->id)
                <x-revenue :listings='$listings'></x-revenue>
                <x-revenue :listings='$listings'></x-revenue>
                <x-revenue :listings='$listings'></x-revenue>
                <x-revenue :listings='$listings'></x-revenue>
            @endif
        </div>
    </div>

    <x-chart></x-chart>

    <div class="gap-5 mt-5 lg:grid lg:grid-cols-5 md:space-y-0">
        @unless ($listings->isEmpty())
            @foreach ($listings as $listing)
                @if (auth()->user() && auth()->user()->id == $listing->user_id)
                    <x-listing-card :listing="$listing" />
                @endif
            @endforeach
        @else
            <p>No Product Found!</p>
        @endunless
    </div>

    <div class="mt-5 lg:flex lg:justify-between">
        <div>
            {{ $listings->links() }}
        </div>
    </div>

    <script>
        var listings = @json($listings);
    </script>

</x-layout>
