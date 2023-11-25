<x-layout>
    <x-card class="p-10 mt-10 w-3/4 mx-40">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">Add Product</h2>
        </header>

        <form method="POST" action="/listings" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                <label for="product" class="inline-block text-lg mb-2">Product Name</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="product" value="{{ old('product') }}" />

                @error('product')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="category" class="inline-block text-lg mb-2">Category</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="category" value="{{ old('category') }}" />

                @error('category')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="quantity" class="inline-block text-lg mb-2">Quantity</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="quantity" placeholder="Please enter per piece only" value="{{ old('quantity') }}" />

                @error('quantity')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="price" class="inline-block text-lg mb-2">
                    Price
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="price" placeholder="Enter per piece" value="{{ old('price') }}" />

                @error('price')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="expiry" class="inline-block text-lg mb-2">
                    Expiry Date
                </label>
                <input type="date" class="border border-gray-200 rounded p-2 w-full" name="expiry" value="{{ old('expiry') }}" />

                @error('expiry')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="sizes" class="inline-block text-lg mb-2">
                    Sizes (Comma Separated)
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="sizes" placeholder="Example: S, M, L, etc" value="{{ old('sizes') }}" />

                @error('sizes')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="logo" class="inline-block text-lg mb-2">
                    Product Logo
                </label>
                <input type="file" class="border border-gray-200 rounded p-2 w-full" name="logo" />

                @error('logo')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="inline-block text-lg mb-2">
                    Product Description
                </label>
                <textarea class="border border-gray-200 rounded p-2 w-full" name="description" rows="10" >{{ old('description') }}</textarea>

                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button type="submit" class="bg-blue-500 rounded py-2 px-4 hover:bg-green-600">
                    Add Product
                </button>

                <a href="/" class="text-black ml-4"> Back </a>
            </div>
        </form>
    </x-card>
</x-layout>
