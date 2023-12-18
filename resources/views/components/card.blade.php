<style scoped>
    @media (max-width: 640px) {
        .card {
            max-width: 200px;
            margin-bottom: 20px;
        }
    }
</style>

<div {{ $attributes->merge(['class' => 'bg-gray-50 border border-black rounded shadow-lg shadow-gray-500 card']) }}>
    {{ $slot }}
</div>
