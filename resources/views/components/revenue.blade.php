<x-card class="p-4 mb-5 text-center text-white" style="background-color: #3490dc">
    <h1 class="text-lg font-bol">Revenue</h1>

    <div class="mt-4 mb-2 text-lg font-bold">
        @php
            // Calculate total revenue from the prices and quantities of listings
            $totalRevenue = 0;

            foreach ($listings as $listing) {
                // Convert the price and quantity to numeric types before adding
                $totalRevenue = ((float) $listing->price - (float) $listing->cost) * (int) $listing->quantity;
            }
        @endphp
        <i class="fa-solid fa-peso-sign"></i> {{ number_format($totalRevenue, 2) }}
    </div>
</x-card>
