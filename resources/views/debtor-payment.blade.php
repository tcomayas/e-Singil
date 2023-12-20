<x-layout :notifs='$notifs'>
    <div class="flex gap-2 mt-5">
        <div>
            <div class="flex flex-row items-center justify-between">
                <div class="flex flex-row gap-3">
                    <x-card class="p-5 text-center">
                        <p>Total Debt:
                            @if (!$total_debt)
                                0
                            @else
                                {{ $total_debt[0]->totaldebt }}
                            @endif
                        </p>
                    </x-card>
                    <button type="button" id="showModal"><i class="fa-solid fa-money-check"></i> PARTIAL</button>
                    <button type="button" id="showFullModal"><i class="fa-solid fa-money-check"></i> Full</button>
                </div>
            </div>

            <div class="w-full p-5" style="max-height: 60vh; overflow-y: scroll; width: 85vw">
                <h1 class="text-center bold" style="font-size: 20px; font-weight: bold; margin-bottom: 10px;">DEBT LIST
                </h1>
                @if ($total_debt === 0)
                    <p class="mt-10 text-center">
                        No Active Debt.
                    </p>
                @else
                    <table class="w-full text-center bg-white border border-gray-300">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border-b">Product</th>
                                <th class="px-4 py-2 border-b">Category</th>
                                <th class="px-4 py-2 border-b">Quantity</th>
                                <th class="px-4 py-2 border-b">Total Price</th>
                                <th class="px-4 py-2 border-b">Date</th>
                                <th class="px-4 py-2 border-b">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $cart)
                                @if ($cart->status == 'Approved')
                                    <tr>
                                        <td class="px-4 py-2 border-b">{{ $cart->listing->product }}</td>
                                        <td class="px-4 py-2 border-b">{{ $cart->listing->category }}</td>
                                        <td class="px-4 py-2 border-b">{{ $cart->quantity }}</td>
                                        <td class="px-4 py-2 border-b">{{ $cart->listing->price * $cart->quantity }}
                                        </td>
                                        <td class="px-4 py-2 border-b">{{ $cart->created_at->diffForHumans() }}</td>
                                        <td class="px-4 py-2 border-b">{{ $cart->status }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            <div class="w-full p-5 mt-10" style="max-height: 60vh; overflow-y: scroll; width: 85vw">
                <h1 class="text-center bold" style="font-size: 20px; font-weight: bold; margin-bottom: 10px;">PAYMENT
                    LIST
                </h1>
                <table class="w-full text-center bg-white border border-gray-300">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border-b">Amount</th>
                            <th class="px-4 py-2 border-b">Name of Witness/Debtor</th>
                            <th class="px-4 py-2 border-b">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                            <tr>
                                <td class="px-4 py-2 border-b">{{ $payment->payment }}</td>
                                <td class="px-4 py-2 border-b">{{ $payment->name }}</td>
                                <td class="px-4 py-2 border-b">{{ $payment->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!--Partial Modal -->
    <div id="partialModal" class="fixed inset-0 z-10 hidden overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div
                class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:w-full sm:max-w-md">
                <button type="button" class="float-right p-2 ml-2 btn btn-secondary" id="closeModal">Close</button>
                <form method="POST" action="/debtor-payment/{{ $carts[0]->user->id }}" class="p-6">
                    @csrf
                    {{ $carts[0]->user->id }}
                    <label for="payVal" class="block text-sm font-medium text-gray-700">Enter partial payment
                        amount:</label>
                    <input type="number" name="payVal" id="payVal"
                        class="block w-full mt-1 border border-gray-500 rounded form-input form-control" required>
                    <label for="name" class="block text-sm font-medium text-gray-700">Paid By:</label>
                    <input type="text" name="name" id="name"
                        class="block w-full mt-1 border border-gray-500 rounded form-input form-control" required>

                    <div class="flex justify-end p-6 bg-gray-50">
                        <button class="btn btn-success" id="payNow" type="submit">
                            <i class="fa-solid fa-shopping-cart"></i> Pay Now
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Full Payment Modal -->
    <div id="fullModal" class="fixed inset-0 z-10 hidden overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div
                class="inline-block p-3 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:w-full sm:max-w-md">
                <p class="text-center form-control">Fully paid debt?
                </p>
                <div class="flex justify-between gap-5">
                    <form method="POST" action="/full-payment/{{ $carts[0]->user->id }}">
                        <label for="name" class="block text-sm font-medium text-gray-700">Paid by:</label>
                        <input type="text" name="name" id="payVal" class="w-full border border-gray-100">
                        @csrf
                        <button type="submit">Yes</button>

                    </form>
                    <button type="button" class="float-right btn btn-secondary" id="closeFullModal">No</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {

            $('#showModal').click(() => {

                var modal = document.getElementById('partialModal');
                modal.classList.remove('hidden');
            })

            $('#closeModal').click(() => {
                var modal = document.getElementById('partialModal');
                modal.classList.add('hidden');
            })

            $('#showFullModal').click(() => {
                var modal2 = document.getElementById('fullModal');
                modal2.classList.remove('hidden');
            })

            $('#closeFullModal').click(() => {

                var modal2 = document.getElementById('fullModal');
                modal2.classList.add('hidden');
            })

        })
    </script>

</x-layout>
