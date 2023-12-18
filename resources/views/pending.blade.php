<x-layout :notifs='$notifs'>
    <div class="w-full p-3">

        @if (count($carts) == 0)
            <p>No Pending Requests!</p>
        @else
            @foreach ($carts->groupBy('user_id') as $userId => $userCarts)
                <x-card class="p-4 mb-4">
                    <h2 class="mb-4 text-2xl font-semibold">Pending Requests for {{ $userCarts->first()->user->name }}
                    </h2>
                    <table class="w-full mb-4 text-center bg-white border border-gray-300">
                        <thead class="bg-gray-300">
                            <tr>
                                <th class="px-4 py-2 border-b">Product</th>
                                <th class="px-4 py-2 border-b">Category</th>
                                <th class="px-4 py-2 border-b">Quantity</th>
                                <th class="px-4 py-2 border-b">Total Price</th>
                                <th class="px-4 py-2 border-b">Date</th>
                                <th class="px-4 py-2 border-b">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userCarts as $cart)
                                @if ($cart->status == 'Pending')
                                    <tr>
                                        <td class="px-4 py-2 border-b">{{ $cart->listing->product }}</td>
                                        <td class="px-4 py-2 border-b">{{ $cart->listing->category }}</td>
                                        <td class="px-4 py-2 border-b">{{ $cart->quantity }}</td>
                                        <td class="px-4 py-2 border-b">{{ $cart->listing->price * $cart->quantity }}
                                        </td>
                                        <td class="px-4 py-2 border-b">{{ $cart->created_at }}</td>
                                        <td class="px-4 py-2 border-b">
                                            <div class="flex flex-row justify-between">
                                                <button onclick="openModal({{ $cart->id }})"
                                                    class="p-2 bg-blue-400 rounded">Approve</button>
                                                <form method="POST" action="/pending/{{ $cart->id }}">
                                                    @csrf
                                                    <input type="hidden" value="Cancel" name="status">
                                                    <button class="p-2 bg-red-400 rounded">CANCEL</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </x-card>
            @endforeach
        @endif

        <!-- Modal -->
        <div class="fixed inset-0 z-10 hidden overflow-y-auto shadow shadow-gray-400" id="myModal">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="relative max-w-md p-8 mx-auto bg-white border border-gray-300 shadow shadow-lg"
                    id="dueModal">
                    <!-- Modal content goes here -->
                </div>
            </div>
        </div>
    </div>

    <script>
        var tempId;

        function openModal(id) {
            console.log(id);
            document.getElementById('myModal').classList.toggle('hidden')
            var buff = `
            <div class="flex flex-col">
                <form method="POST" action="/pending/${id}">
                    @csrf
                    <button type="button" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600" onclick="closeModal()">Close</button>
                    <h2 class="mb-4 text-2xl font-semibold">Due Date</h2>
                    <input type="date" name="duedate" id="duedate" />
                    <div>
                        <input type="hidden" value="Approve" name="status">
                        <button type="submit">Set Due Date</button>
                    </div>
                </form>
            </div>
            `
            $('#dueModal').empty().html(buff);
        }

        function closeModal() {
            document.getElementById('myModal').classList.add('hidden');
        }
    </script>
</x-layout>
