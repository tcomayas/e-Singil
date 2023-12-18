<x-layout :notifs='$notifs'>
    <x-card class="w-3/4 p-10 mx-40 mt-10">
        <header class="text-center">
            <h2 class="mb-1 text-2xl font-bold uppercase">Add Product</h2>
        </header>

        <form method="POST" action="/listings" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                <label for="product" class="inline-block mb-2 text-lg">Product Name</label>
                <input type="text" class="w-full p-2 border border-gray-200 rounded" name="product"
                    value="{{ old('product') }}" />

                @error('product')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="category" class="inline-block mb-2 text-lg">Category</label>
                <input type="text" class="w-full p-2 border border-gray-200 rounded" name="category"
                    value="{{ old('category') }}" />

                @error('category')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="quantity" class="inline-block mb-2 text-lg">Quantity</label>
                <input type="text" class="w-full p-2 border border-gray-200 rounded" name="quantity"
                    placeholder="Please enter per piece only" value="{{ old('quantity') }}" />

                @error('quantity')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="cost" class="inline-block mb-2 text-lg">Acquisition Cost</label>
                <input type="text" class="w-full p-2 border border-gray-200 rounded" name="cost"
                    placeholder="Please enter per piece only" value="{{ old('cost') }}" />

                @error('cost')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="price" class="inline-block mb-2 text-lg">
                    Price
                </label>
                <input type="text" class="w-full p-2 border border-gray-200 rounded" name="price"
                    placeholder="Enter per piece" value="{{ old('price') }}" />

                @error('price')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="expiry" class="inline-block mb-2 text-lg">
                    Expiry Date
                </label>
                <input type="date" class="w-full p-2 border border-gray-200 rounded" name="expiry"
                    value="{{ old('expiry') }}" />

                @error('expiry')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="logo" class="inline-block mb-2 text-lg">
                    Product Logo
                </label>
                <input type="file" class="w-full p-2 border border-gray-200 rounded" name="logo" />

                @error('logo')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="inline-block mb-2 text-lg">
                    Product Description
                </label>
                <textarea class="w-full p-2 border border-gray-200 rounded" name="description" rows="10">{{ old('description') }}</textarea>

                @error('description')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button type="submit" class="px-4 py-2 bg-blue-500 rounded hover:bg-green-600">
                    Add Product
                </button>

                <a href="/" class="ml-4 text-black"> Back </a>
            </div>
        </form>
    </x-card>
</x-layout>
