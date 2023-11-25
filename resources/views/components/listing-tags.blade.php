@props(['sizesCsv'])

@php
    $sizes = explode(',', $sizesCsv)
@endphp


<ul class="flex justify-center mt-2">
    @foreach ($sizes as $sizes)

    <li class="flex items-center justify-center bg-orange-500 w-10 text-white rounded-xl py-1 px-3 mr-2 text-xs">
        <a href="/listings/inventory?sizes={{ $sizes }}">{{ $sizes }}</a>
    </li>

    @endforeach
</ul>
