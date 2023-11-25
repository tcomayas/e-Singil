<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-10">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">Edit Product</h2>
            <p class="mb-4">Edit: {{ $listing->product }}</p>
        </header>

        <form method="POST" action="/listings/{{ $listing->id }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label for="product" class="inline-block text-lg mb-2">Product Name</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="product"
                    value="{{ $listing->category }}" />

                @error('product')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6 flex gap-2 ">
                <div>
                    <label for="category" class="inline-block text-lg mb-2">Category</label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="category"
                        placeholder="Example: 4:00PM - 10:00PM" value="{{ $listing->category }}" />

                    @error('category')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="quantity" class="inline-block text-lg mb-2">Quantity</label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="quantity"
                        value="{{ $listing->quantity }}" />

                    @error('quantity')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6 flex gap-2">
                <div>
                    <label for="price" class="inline-block text-lg mb-2">
                        Price
                    </label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="price"
                        value="{{ $listing->price }}" />


                    @error('price')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="expiry" class="inline-block text-lg mb-2">
                        Expiry
                    </label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="expiry"
                        value="{{ $listing->expiry }}" />

                    @error('expiry')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                </div>

            </div>

            <div class="mb-6">
            </div>

            <div class="mb-6">
                <label for="sizes" class="inline-block text-lg mb-2">
                    Sizes (Comma Separated)
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="sizes"
                    placeholder="Example: Tuslob buwa, BBQ, Seafoods, etc" value="{{ $listing->sizes }}" />

                @error('sizes')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="logo" class="inline-block text-lg mb-2">
                    Product Logo
                </label>
                <input type="file" class="border border-gray-200 rounded p-2 w-full" name="logo" />

                <img class="w-48 mr-6 mb-6"
                    src="{{ $listing->logo ? asset('storage/' . $listing->logo) : asset('/images/no-image.png') }}"
                    alt="" />

                @error('logo')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="inline-block text-lg mb-2">
                    Product Description
                </label>
                <textarea class="border border-gray-200 rounded p-2 w-full" name="description" rows="10">{{ $listing->description }}</textarea>

                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button class="bg-blue-500 text-white rounded py-2 px-4 hover:bg-orange-500 hover:text-white">
                    Update Product
                </button>

                <a href="/" class="text-black ml-4"> Back </a>
            </div>
        </form>
    </x-card>
</x-layout>
