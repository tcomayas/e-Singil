@props(['listings'])

<x-app-layout>
    <div class="flex">
        <x-sidebar class="relative mt-2"></x-sidebar>

        <!-- Content -->
        <div class="flex-1 p-8 mx-2 mt-5">

            <div>
                @include('partials._search')
            </div>

            <div class="gap-5 mt-5 lg:grid lg:grid-cols-5 md:space-y-0">
                @unless ($listings->isEmpty())
                    @foreach ($listings as $listing)
                        <x-listing-card :listing="$listing" class="font-bold"/>
                    @endforeach
                @else
                    <p>No Product Found!</p>
                @endunless
            </div>

            <div class="mt-5 lg:flex lg:justify-between">
                <div>
                    @if (isset($listings) && $listings->count() > 0)
                        {{ $listings->links() }}
                    @else
                        <p>No listings to paginate.</p>
                    @endif
                </div>
            </div>

            <script>
                var listings = @json($listings);
            </script>

        </div>
    </div>
</x-app-layout>
