<x-card class="p-4 mb-5 text-center text-white" style="background-color: rgb(249 115 22);">
    <h1 class="text-lg font-bold">Products</h1>

    <div class="flex flex-row items-center justify-between mt-4 mb-2 text-lg font-bold">

        <i class="fa-solid fa-cart-shopping"></i> {{ count($listings) }}

        {{-- <i class="fas fa-money-bill" style="color: orange;"></i> ₱ {{ number_format($totalRevenue, 2) }} --}}
    </div>
</x-card>
