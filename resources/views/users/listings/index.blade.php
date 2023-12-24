<x-layout :notifs='$notifs'>
    <style>
        .fixed-width {
            width: 200px !important;
            height: 100px !important;

        }
    </style>
    <div>
        <div class="flex justify-between mt-5">
            @if (auth()->user() && auth()->user()->id)
                <x-total-sales :totalSales='$totalSales'></x-total-sales>
                <x-debtor-count :users='$users' class="fixed-width"></x-debtor-count>
                <x-product-count :listings='$listings' class="fixed-width"></x-product-count>
                <x-card class="flex flex-col items-center justify-center text-white fixed-width"
                    style="width: 100px; background-color: rgb(132 204 22);">
                    <h1 style="font-size: 18px; font-weight: bold;">Total Debt</h1>
                    <div class="flex flex-row items-center justify-between">
                        <i class="fa-solid fa-peso-sign"></i>
                        <p style="font-weight: bold;"> {{ $total }}</p>
                    </div>
                </x-card>
            @endif
        </div>
    </div>

    <x-chart></x-chart>


    <div class="p-5 mt-10">
        <h1 class="mb-3 text-center" style="font-size: 30px; font-weight: bold; text-decoration: underline;">Trending
            Products
        </h1>
        <div class="flex flex-row gap-2">
            @foreach ($collections as $trend)
                <x-card class="p-5 text-center ">
                    <p>{{ $trend[0]->product }}</p>
                    <p>{{ $trend[0]->category }}</p>
                    <p>{{ $trend[0]->price }}</p>
                </x-card>
            @endforeach
        </div>
    </div>

    <div class="mt-5 lg:flex lg:justify-between">
        <div>
            {{ $listings->links() }}
        </div>
    </div>

    <script>
        var categoryCounts = @json($categoryCounts);

        var categoryTotalPrices = @json($categoryTotalPrices);
    </script>

</x-layout>
