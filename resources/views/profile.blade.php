<x-app-layout>
    <div class="flex">
        <div class="w-1/4">
            <div class="mt-10 text-center border shadow-md user-card border-gray">
                <img class="w-full user-photo" src="{{ asset($user->photo) }}" alt="User Photo">
                <h3 class="text-lg font-bold">{{ $user->name }}</h3>
                <p>{{ $user->address }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
