<style scoped>
    .qrcode {
        width: 400px;
        border: 10px solid blue;
        border-radius: 10px;
        margin: auto;
    }
</style>


<x-app-layout>
    <div class="flex flex-row gap-5">
        <x-sidebar></x-sidebar>
        <img src="{{ asset('images/gcash.jpg') }}" alt="GCash QR Code" class="qrcode">
    </div>
</x-app-layout>
