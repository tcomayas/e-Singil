<x-layout :notifs='$notifs'>
    <form action="/users/listings/inventory">
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

    @if (auth()->user())
        @if ($listings->isEmpty())
            <p class="mt-5 text-center">No Product Found!</p>
        @else
            <div style="max-height: 370px !important; overflow-y: scroll !important; border-bottom: 1px solid black;">
                <table class="table w-full mt-4 text-center border border-collapse border-gray-300">
                    <thead>
                        <tr>
                            <th class="bg-gray-300 border border-black">Product</th>
                            <th class="bg-gray-300 border border-black">Category</th>
                            <th class="bg-gray-300 border border-black">Quantity</th>
                            <th class="bg-gray-300 border border-black">Cost</th>
                            <th class="bg-gray-300 border border-black">Price</th>
                            <th class="bg-gray-300 border border-black">Expiry</th>
                            <th class="bg-gray-300 border border-black">Date Purchased</th>
                            <th class="bg-gray-300 border border-black">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listings as $listing)
                            <tr>
                                <td class="border border-black">{{ $listing->product }}</td>
                                <td class="border border-black">{{ $listing->category }}</td>
                                <td class="border border-black">{{ $listing->quantity }}</td>
                                <td class="border border-black">{{ $listing->cost }}</td>
                                <td class="border border-black">{{ $listing->price }}</td>
                                <td class="border border-black">{{ $listing->created_at }}</td>
                                <td class="border border-black">{{ $listing->expiry }}</td>
                                <td class="border border-black">
                                    @if ($listing->user_id == auth()->user()->id)
                                        <a href="/listings/{{ $listing->id }}/edit" class="btn btn-secondary"><i
                                                class="fa-solid fa-pen-to-square"></i></a>

                                        <!-- Delete Confirmation Modal -->
                                        <div id="passwordModal{{ $listing->id }}" class="modal"
                                            style="display: none;">
                                            <form method="POST" action="/listings/{{ $listing->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <label for="password" class="block">Enter your password:</label>
                                                <input type="password" name="password" id="password{{ $listing->id }}"
                                                    class="form-control" required>
                                                <button type="submit" class="btn btn-danger"><i
                                                        class="fa-solid fa-trash"></i></button>
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

            </div>

            <div>
                <button class="bottom-0 float-right p-2 mt-5 mr-5 font-bold text-white bg-blue-400"
                    style="border-radius: 10px" onclick="openBuyNowModal('{{ $listing->id }}')">Add
                    Sales</button>
            </div>
            {{-- Add Sales Modal --}}
            <div id="buyNowModal{{ $listing->id }}" class="fixed inset-0 z-10 hidden overflow-y-auto">
                <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>
                    <div
                        class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:w-full sm:max-w-md">
                        <form method="POST" action="/add/sales">
                            @csrf
                            <button type="button" class="float-right p-2 ml-2 btn btn-secondary"
                                onclick="closeBuyNowModal('{{ $listing->id }}')">Close</button>
                            <div class="p-6">
                                <label for="item" class="block text-sm font-medium text-gray-700">Select
                                    Product:</label>
                                <select name="item" id="item-name"
                                    class="p-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                                    <option value="none"></option>
                                    @foreach ($listings as $list)
                                        <option value="{{ $list->id }}">{{ $list->product }}</option>
                                    @endforeach
                                </select>
                                <label for="quantity" class="block text-sm font-medium text-gray-700">Enter
                                    quantity:</label>
                                <input type="text" name="quantity"
                                    class="p-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                                <label for="Sales"
                                    class="block text-sm font-medium text-gray-700">Description:</label>
                                <textarea name="description" id="" cols="30" rows="10"></textarea>
                            </div>
                            <div class="flex justify-end p-6 bg-gray-50">
                                <button type="submit" class=" btn btn-success" style="font-weight: 700 !important; ">
                                    <i class="fa-solid fa-shopping-cart"></i> Add Sales
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

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
                // SCRIPT FOR BUY NOW MODEL
                function openBuyNowModal(listingId) {
                    var modal = document.getElementById('buyNowModal' + listingId);
                    modal.classList.remove('hidden');
                }

                function closeBuyNowModal(listingId) {
                    var modal = document.getElementById('buyNowModal' + listingId);
                    modal.classList.add('hidden');
                }
            </script>
        @endif
    @endif
</x-layout>
