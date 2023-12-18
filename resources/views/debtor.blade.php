@props(['listings'])

<x-app-layout>
    <style scoped>
        @import '~@fortawesome/fontawesome-free/css/all.min.css';

        .main-menu {
            height: 85vh;
            width: 9.6vw;
            transition: all 1s cubic-bezier(0.79, 0.33, 0.14, 0.53);

        }

        .btn-menu {
            padding: 0;
            margin: 0;
            text-align: center;
            margin-left: 15px;
        }

        aside {
            height: 89.5vh;
            padding: 5px;
            box-shadow: 10px 0px 17px -9px rgba(0, 0, 0, 1) !important;

        }

        @media (max-width: 640px) {
            #wrapper {
                display: flex;
                gap: 30px;
            }
        }
    </style>
    <div class="flex" id="wrapper">
        <x-sidebar class="relative mt-2"></x-sidebar>

        <!-- Content -->
        <div class="flex-1 p-8 mx-2 mt-5">

            <div>
                @include('partials._search')
            </div>

            <div class="gap-5 mt-5 lg:grid lg:grid-cols-5 md:space-y-0">
                @unless ($listings->isEmpty())
                    @foreach ($listings as $listing)
                        <x-listing-card :listing="$listing" class="font-bold" id="card" style="margin-bottom: 10px" />
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

            <x-flash-message />
            <script>
                var listings = @json($listings);
            </script>

        </div>
    </div>
</x-app-layout>
