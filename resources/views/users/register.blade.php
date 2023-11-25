<x-layout>
    <x-card class="w-4/5 h-full p-5 mx-auto mt-5">
        <div class="flex">
            <div id="first" class="flex-1">
                <a href="/"><img class="w-3/4 h-full rounded" src="{{ asset('images/store.jpg') }}" alt=""/></a>
            </div>

            <div class="flex-1 mt-24">
                <header>
                    <h2 class="mb-4 text-2xl font-bold uppercase">
                        Create Account
                    </h2>
                </header>

                <form method="POST" action="/users" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-6">
                        <label for="photo" class="inline-block mb-2 text-lg">
                            Profile Picture
                        </label>
                        <input type="file" class="w-full p-2 border border-gray-200 rounded" name="photo"
                            value="{{ old('photo') }}" />

                        @error('photo')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="name" class="inline-block mb-2 text-lg">
                            Name
                        </label>
                        <input type="text" class="w-full p-2 border border-gray-200 rounded" name="name"
                            value="{{ old('name') }}" />

                        @error('name')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="address" class="inline-block mb-2 text-lg">
                            Address
                        </label>
                        <input type="text" class="w-full p-2 border border-gray-200 rounded" name="address"
                            value="{{ old('address') }}" />

                        @error('address')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="email" class="inline-block mb-2 text-lg">Email</label>
                        <input type="email" class="w-full p-2 border border-gray-200 rounded" name="email"
                            value="{{ old('email') }}" />

                        @error('email')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="password" class="inline-block mb-2 text-lg">
                            Password
                        </label>
                        <input type="password" class="w-full p-2 border border-gray-200 rounded" name="password"
                            value="{{ old('password') }}" />

                        @error('password')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="password2" class="inline-block mb-2 text-lg">
                            Confirm Password
                        </label>
                        <input type="password" class="w-full p-2 border border-gray-200 rounded"
                            name="password_confirmation" value="{{ old('password_confirmation') }}" />

                        @error('password_confirmation')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <button type="submit" class="px-4 py-2 bg-teal-300 rounded hover:bg-black hover:text-white">
                            Sign Up
                        </button>
                    </div>

                    <div class="mt-8">
                        <p>
                            Already have an account?
                            <a href="/login" class="text-sky-500">Login</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>

    </x-card>
</x-layout>
