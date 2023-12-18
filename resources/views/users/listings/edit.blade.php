<x-layout :notifs='$notifs'>
    <x-card class="max-w-lg p-10 mx-auto mt-10">
        <header class="text-center">
            <h2 class="mb-1 text-2xl font-bold uppercase">Edit Product</h2>
            <p class="mb-4">Edit: {{ $listing->product }}</p>
        </header>

        <form method="POST" action="/listings/{{ $listing->id }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label for="product" class="inline-block mb-2 text-lg">Product Name</label>
                <input type="text" class="w-full p-2 border border-gray-200 rounded" name="product"
                    value="{{ $listing->category }}" />

                @error('product')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-2 mb-6 ">
                <div>
                    <label for="category" class="inline-block mb-2 text-lg">Category</label>
                    <input type="text" class="w-full p-2 border border-gray-200 rounded" name="category"
                        placeholder="Example: 4:00PM - 10:00PM" value="{{ $listing->category }}" />

                    @error('category')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="quantity" class="inline-block mb-2 text-lg">Quantity</label>
                    <input type="text" class="w-full p-2 border border-gray-200 rounded" name="quantity"
                        value="{{ $listing->quantity }}" />

                    @error('quantity')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex gap-2 mb-6">
                <div>
                    <label for="price" class="inline-block mb-2 text-lg">
                        Price
                    </label>
                    <input type="text" class="w-full p-2 border border-gray-200 rounded" name="price"
                        value="{{ $listing->price }}" />


                    @error('price')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="expiry" class="inline-block mb-2 text-lg">
                        Expiry
                    </label>
                    <input type="text" class="w-full p-2 border border-gray-200 rounded" name="expiry"
                        value="{{ $listing->expiry }}" />

                    @error('expiry')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror

                </div>

            </div>

            <div class="mb-6">
                <label for="logo" class="inline-block mb-2 text-lg">
                    Product Logo
                </label>
                <input type="file" class="w-full p-2 border border-gray-200 rounded" name="logo" />

                <img class="w-48 mb-6 mr-6"
                    src="{{ $listing->logo ? asset('storage/' . $listing->logo) : asset('/images/no-image.png') }}"
                    alt="" />

                @error('logo')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="inline-block mb-2 text-lg">
                    Product Description
                </label>
                <textarea class="w-full p-2 border border-gray-200 rounded" name="description" rows="10">{{ $listing->description }}</textarea>

                @error('description')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-orange-500 hover:text-white">
                    Update Product
                </button>

                <a href="/" class="ml-4 text-black"> Back </a>
            </div>
        </form>
    </x-card>
</x-layout>
