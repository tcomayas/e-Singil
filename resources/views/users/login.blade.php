<x-layout>
    <x-flash-message />
    <div class="flex items-center justify-center h-screen mx-auto">
        <x-card class="p-10 ">
            <div class="flex">
                <div id="first" class="flex-1">
                    <a href="/"><img class="w-4/5 h-full rounded" src="{{ asset('images/store.jpg') }}"
                            alt="" /></a>
                </div>

                <div class="flex-1 mt-24">
                    <header class="text-center">
                        <h2 class="mb-1 text-2xl font-bold uppercase">
                            Login
                        </h2>
                        <p class="mb-4">Login to your account</p>
                    </header>

                    <form method="POST" action="/users/authenticate">
                        @csrf

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
                            <button type="submit"
                                class="px-4 py-2 bg-teal-300 rounded hover:bg-black hover:text-white">
                                Sign In
                            </button>
                        </div>

                        <div class="mt-8">
                            <p>
                                Don't have an account?
                                <a href="/register" class="text-sky-500">Register</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </x-card>
    </div>
</x-layout>
