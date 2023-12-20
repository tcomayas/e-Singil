<x-layout :notifs='$notifs'>
    <form action="/listings/product">
        @csrf
        <div class="flex justify-end">
            <div class="relative flex mt-4 mb-4 border-2 border-gray-100 rounded-lg w-100">
                <div class="relative mx-2 top-4">
                    <i class="z-20 text-gray-400 fa fa-search hover:text-gray-500"></i>
                </div>
                <input type="text" name="search"
                    class="z-0 w-full pr-20 rounded-lg h-14 focus:shadow focus:outline-none"
                    placeholder="Search Product..." />
                <div class="absolute top-2 right-2">
                    <button type="submit"
                        class="w-20 h-10 text-black bg-blue-300 rounded-lg hover:bg-green-600 opacity-90">
                        Search
                    </button>
                </div>
            </div>
        </div>
    </form>
    @unless ($listings->isEmpty())

        @if (auth()->user())
            @php
                $listingsByCategory = $listings->groupBy('category');
            @endphp

            @foreach ($listingsByCategory as $category => $categoryListings)
                <h2 class="mt-4 text-2xl font-bold">{{ $category }}</h2>
                <table class="table w-full mt-4 text-center border border-collapse border-gray-300">
                    <thead>
                        <tr>
                            <th class="bg-gray-300 border border-black">Product</th>
                            <th class="bg-gray-300 border border-black">Quantity</th>
                            <th class="bg-gray-300 border border-black">Expiry</th>
                            <th class="bg-gray-300 border border-black">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categoryListings as $listing)
                            <tr>
                                <td class="border border-black">{{ $listing->product }}</td>
                                <td class="border border-black">{{ $listing->quantity }}</td>
                                <td class="border border-black">{{ $listing->expiry }}</td>
                                <td class="border border-black">
                                    @if ($listing->user_id == auth()->user()->id)
                                        <a href="/listings/{{ $listing->id }}/edit" class="btn btn-secondary"><i
                                                class="fa-solid fa-pen-to-square"></i></a>

                                        <!-- Delete Confirmation Modal -->
                                        <div id="passwordModal{{ $listing->id }}" class="modal" style="display: none;">
                                            <form method="POST" action="/listings/{{ $listing->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <label for="password" class="block">Enter your password:</label>
                                                <input type="password" name="password" id="password{{ $listing->id }}"
                                                    class="form-control" required>
                                                <button type="button" class="btn btn-secondary"
                                                    onclick="closeModal('{{ $listing->id }}')">Close</button>
                                            </form>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach

            <!-- Script to handle modal opening/closing -->
            <script>
                function openModal(listingId) {
                    var modal = document.getElementById('passwordModal' + listingId);
                    modal.style.display = 'block';
                }

                function closeModal(listingId) {
                    var modal = document.getElementById('passwordModal' + listingId);
                    modal.style.display = 'none';
                }
            </script>
        @endif
    @else
        <p class="mt-5 text-center">No Product Found!</p>
    @endunless
</x-layout>
