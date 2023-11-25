<x-layout>
    @if (auth()->user())
    @if ($listings->isEmpty())
            <p class="mt-5 text-center">No Product Found!</p>
        @else
        <table class="table w-full mt-4 text-center border border-collapse border-gray-300">
            <thead>
                <tr>
                    <th class="bg-gray-300 border border-black">Product</th>
                    <th class="bg-gray-300 border border-black">Category</th>
                    <th class="bg-gray-300 border border-black">Quantity</th>
                    <th class="bg-gray-300 border border-black">Sizes</th>
                    <th class="bg-gray-300 border border-black">Expiry</th>
                    <th class="bg-gray-300 border border-black">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listings as $listing)
                    <tr>
                        <td class="border border-black">{{ $listing->product }}</td>
                        <td class="border border-black">{{ $listing->category }}</td>
                        <td class="border border-black">{{ $listing->quantity }}</td>
                        <td class="border border-black"><x-listing-tags :sizesCsv="$listing->sizes" /></td>
                        <td class="border border-black">{{ $listing->expiry }}</td>
                        <td class="border border-black">
                            @if ($listing->user_id == auth()->user()->id)
                                <a href="/listings/{{ $listing->id }}/edit" class="btn btn-secondary"><i
                                        class="fa-solid fa-pen-to-square"></i></a>

                                <!-- Button to open the delete confirmation modal -->
                                <button type="button" class="btn btn-warning"
                                    onclick="openModal('{{ $listing->id }}')"><i class="fa-solid fa-trash"></i></button>

                                <!-- Delete Confirmation Modal -->
                                <div id="passwordModal{{ $listing->id }}" class="modal" style="display: none;">
                                    <form method="POST" action="/listings/{{ $listing->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <label for="password" class="block">Enter your password:</label>
                                        <input type="password" name="password" id="password{{ $listing->id }}"
                                            class="form-control" required>
                                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
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
    @endif
</x-layout>
