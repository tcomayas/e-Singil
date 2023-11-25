<x-layout>
    @include('partials._search')
    <a href="/" class="inline-block mb-4 ml-4 text-black">
        <i class="fa-solid fa-arrow-left"></i> Back
    </a>
    <div class="mx-4">
        <x-card class="p-10">
            <div class="flex flex-col items-center justify-center text-center">
                <img class="w-48 mb-6 mr-6" src="{{ $listing->logo ? asset('storage/' . $listing->logo) : asset('/images/no-image.png')}}" alt="" />

                <h3 class="mb-2 text-2xl">
                    {{ $listing->product }}
                </h3>
                <div class="mb-4 text-xl font-bold">
                    {{ $listing->category }}</div>
                <ul class="flex">
                    <x-listing-tags :sizesCsv="$listing->sizes" />
                </ul>
                <div class="my-4 text-lg">
                    <i class="fa-solid fa-dollar-sign"></i>
                    {{ $listing->price }}
                </div>
                <div class="my-4 text-lg">
                    <i class="fa-solid fa-briefcase"></i>
                    {{ $listing->quantity }}

                    <a href="mailto:{{ $listing->quantity }}"
                        class="block py-2 mt-6 bg-teal-300 rounded-xl hover:opacity-80"><i
                            class="fa-solid fa-envelope"></i>
                        Purchase</a>

                    <a href="
                                {{ $listing->expiry }}" target="_blank"
                        class="block py-2 mt-4 text-white bg-black rounded-xl hover:opacity-80"><i
                            class="fa-solid fa-globe"></i> Visit
                        Website</a>
                </div>
                <div class="w-full mb-6 border border-gray-200"></div>
                <div>
                    <h3 class="mb-4 text-3xl font-bold">
                        Product Description
                    </h3>
                    <div class="space-y-6 text-lg">
                        <p>

                            {{ $listing->description }}
                        </p>
                    </div>
                </div>
            </div>
        </x-card>
    </div>
</x-layout>
