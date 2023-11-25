<x-card class="mb-5 text-center p-4">
    <h1 class="text-lg font-bold">Revenue</h1>

    <div class="mt-4 mb-2 text-lg font-bold">
        @php
            // Calculate total revenue from the prices and quantities of listings
            $totalRevenue = 0;

            foreach ($listings as $listing) {
                // Convert the price and quantity to numeric types before adding
                $totalRevenue += (float)$listing->price * (int)$listing->quantity;
            }
        @endphp

        <i class="fas fa-money-bill" style="color: orange;"></i> ₱ {{ number_format($totalRevenue, 2) }}
    </div>
</x-card>
