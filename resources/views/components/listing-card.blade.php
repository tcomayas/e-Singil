@props(['listing'])
<style scoped>
    button:hover {
        background-color: blue;
    }

    #credit {
        display: flex;
        justify-items: center;
        align-items: center;

    }

    @media screen and (max-width: 1024px) {
        #card {
            height: 50%;
            padding: 1px !important;
        }

        h3 {
            font-size: 15px !important;
        }

        #category {
            font-size: 12px;
            margin-bottom: 1px;
        }

        #quantity,
        #price,
        #expiry {
            font-size: 10px;
            margin-bottom: 1px;
        }
    }
</style>
<x-card id="card">
    <div class="flex items-center p-5 text-center">
        <div>
            <h3 class="text-2xl">
                <a href="/listings/{{ $listing->id }}">{{ $listing->product }}</a>
            </h3>
            <div class="mb-4 text-xl font-bold" id="category"><i class="fa-solid fa-book"></i>
                {{ $listing->category }}
            </div>
            @if (auth()->check() && auth()->user()->id == '1')
                <div class="text-xl font-bold text-center" id="quantity">QTY: {{ $listing->quantity }}</div>
            @endif
            <div class="text-xl font-bold text-center" id="price">Qty: {{ $listing->quantity }}</div>
            <div class="text-xl font-bold text-center" id="price">₱{{ $listing->price }}</div>
            <div class="mt-4 text-lg" id="expiry">
                <i class="fa-solid fa-calendar"></i>
                {{ $listing->expiry }}
            </div>

            <div class="flex items-center" id="credit">
                @if (auth()->check() && auth()->user()->id !== $listing->user_id)
                    @if ($listing->quantity >= 1)
                        <!-- Button to trigger the Buy Now modal -->
                        <button type="button"
                            class="px-4 py-2 font-semibold text-blue-700 bg-blue-400 border rounded hover:bg-orange-700 hover:text-white hover:border-transparent"
                            onclick="openBuyNowModal('{{ $listing->id }}')"
                            style="background-color: blue; color: white;  margin: auto;">Credit
                            Now</button>
                    @else
                        <p>No more products like this!</p>
                    @endif
                @endif
            </div>

            <!-- Buy Now Modal -->
            <div id="buyNowModal{{ $listing->id }}" class="fixed inset-0 z-10 hidden overflow-y-auto">
                <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>
                    <div
                        class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:w-full sm:max-w-md">
                        <form method="POST" action="/debtor/{{ $listing->id }}">
                            @csrf
                            <button type="button" class="float-right p-2 ml-2 btn btn-secondary"
                                onclick="closeBuyNowModal('{{ $listing->id }}')">Close</button>
                            <div class="p-6">
                                <label for="quantity" class="block text-sm font-medium text-gray-700">Enter quantity
                                    to
                                    buy:</label>
                                <input type="number" name="quantity" id="quantity"
                                    class="block w-full mt-1 border border-gray-500 rounded form-input form-control"
                                    required>
                            </div>
                            <div class="flex justify-end bg-gray-50">
                                <button type="submit" class="mx-5 btn btn-success"
                                    style="font-weight: 700 !important; margin-left: 10px;">
                                    <i class="fa-solid fa-shopping-cart"></i> Credit Now
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
</x-card>

<div class="flex items-center justify-between mt-5">
    @if ($listing->user_id == auth()->user()->id)
        <a href="/listings/{{ $listing->id }}/edit" class="btn btn-secondary"><i
                class="fa-solid fa-pen-to-square"></i></a>
        <!-- Button to open the delete confirmation modal -->
        <button type="button" class="btn btn-warning" onclick="openModal('{{ $listing->id }}')"><i
                class="fa-solid fa-trash"></i></button>
    @endif
</div>
</div>
</div>

<!-- Script to handle modal opening/closing -->
<script>
    function openBuyNowModal(listingId) {
        var modal = document.getElementById('buyNowModal' + listingId);
        modal.classList.remove('hidden');
    }

    function closeBuyNowModal(listingId) {
        var modal = document.getElementById('buyNowModal' + listingId);
        modal.classList.add('hidden');
    }

    function openModal(listingId) {
        var modal = document.getElementById('passwordModal' + listingId);
        modal.style.display = 'block';
    }

    function closeModal(listingId) {
        var modal = document.getElementById('passwordModal' + listingId);
        modal.style.display = 'none';
    }
</script>
