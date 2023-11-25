<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="images/logo.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{ asset('assets/js/chart.js') }}"></script>

    <script src="https://cdn.tailwindcss.com"></script>



    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        laravel: "#ef3b2d",
                    },
                },
            },
        };
    </script>


    <link rel="icon" href="image/logo.png" type="image/x-icon">

    <title>e-Singil</title>
    <style>
        /* Add this CSS to your existing styles */

        /* Default styles for larger screens */
        .nav-wrapper {
            width: 240px;
            /* Adjust the width as needed */
        }

        /* Responsive styles for smaller screens */
        @media (max-width: 768px) {
            .nav-wrapper {
                width: 100%;
                /* Make the width 100% for smaller screens */
            }

            .nav-wrapper ul {
                padding: 0;
            }

            .nav-wrapper li {
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body class="mb-48">

    @if (!request()->is('login', 'register'))
        <nav class="flex items-center justify-between bg-gray-200">
            <a href="/">
                <img class="w-24 mx-5" src="{{ asset('images/logo.png') }}" alt="">
            </a>
            <ul class="flex mr-6 space-x-6">
                @auth
                    <li x-data="{ open: false }" class="relative">
                        <div class="flex gap-1">
                            <button @click="open = !open"
                                class="inline-flex px-4 rounded-md text-dark focus:outline-none focus:border-blue-300 focus:shadow-outline-blue hover:text-white">
                                <i class="mx-2 mt-1 fas fa-user"></i> {{ auth()->user()->name }}
                                <svg class="w-4 h-4 ml-2 -mr-1" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7">
                                    </path>
                                </svg>
                            </button>
                        </div>
                        <div x-show="open" @click.away="open = false"
                            class="absolute left-0 z-50 p-2 mt-2 bg-white border border-gray-300 rounded-md shadow-lg text-start">
                            <a href="/listings/manage" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                <i class="mr-2 fa-solid fa-gear"></i> Manage Products
                            </a>
                            <form method="POST" action="/logout"
                                class="block px-4 py-2 text-sm text-red-500 hover:bg-gray-100">
                                @csrf
                                <button type="submit">
                                    <i class="mr-2 fa-solid fa-door-closed"></i> Logout
                                </button>
                            </form>
                        </div>
                    </li>
                @else
                    <li>
                        <a href="../register" class="hover:text-laravel">
                            <i class="fa-solid fa-user-plus"></i> Register
                        </a>
                    </li>
                    <li>
                        <a href="../login" class="hover:text-laravel">
                            <i class="fa-solid fa-arrow-right-to-bracket"></i> Login
                        </a>
                    </li>
                @endauth
            </ul>
        </nav>

        <div class="hidden menu-btn" onclick="toggleMenu()">
            <i class="fas fa-bars"></i>
        </div>

        <div class="flex gap-20">
            <nav class="items-center w-40 h-screen p-5 text-white bg-blue-500 border-black shadow-lg nav-wrapper">
                <ul>
                    @auth
                        <li class="mt-5 mb-4">
                            <a href="/" class="flex items-center text-dark hover:text-gray-300">
                                <span class="mr-2"><i class="fas fa-home"></i></span> HOME
                            </a>
                        </li>
                        <li class="mb-4">
                            <a href="/debt" class="flex items-center text-dark hover:text-gray-300">
                                <span class="mr-2"><i class="fas fa-money-bill-wave"></i></span> DEBT
                            </a>
                        </li>
                        <li class="mb-4">
                            <a href="/listings/inventory" class="flex items-center text-dark hover:text-gray-300">
                                <span class="mr-2"><i class="fas fa-boxes"></i></span> INVENTORY
                            </a>
                        </li>
                        <li class="mb-4">
                            <a href="#" class="flex items-center text-dark hover:text-gray-300">
                                <span class="mr-2"><i class="fas fa-chart-bar"></i></span> REPORT
                            </a>
                        </li>
                        <li class="mb-4">
                            <a href="#" class="flex items-center text-dark hover:text-gray-300">
                                <span class="mr-2"><i class="fas fa-history"></i></span> HISTORY
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="/register" class="hover:text-laravel"><i class="fa-solid fa-user-plus"></i>
                                Register</a>
                        </li>
                        <li>
                            <a href="/login" class="hover:text-laravel"><i class="fa-solid fa-arrow-right-to-bracket"></i>
                                Login</a>
                        </li>
                    @endauth


                    <li class="mb-4">
                        <a href="/listings/product" class="flex items-center text-dark hover:text-gray-300">
                            <span class="mr-2"><i class="fas fa-box"></i></span> PRODUCTS
                        </a>
                    </li>
                </ul>
    @endif
    </nav>

    <main class="w-full">
        {{ $slot }}
    </main>
    @if (!request()->is('login', 'register'))
        <footer
            class="fixed bottom-0 left-0 flex items-center justify-start w-full h-24 mt-24 font-bold opacity-90 md:justify-center">

            <a href="/listings/create"
                class="absolute px-5 py-2 text-white bg-blue-500 rounded top-1/3 right-10 hover:bg-green-600">Add
                Product</a>
        </footer>
    @endif
    <x-flash-message />
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // JavaScript function to toggle the mobile menu
        function toggleMenu() {
            var menuBtn = document.querySelector('.menu-btn');
            menuBtn.classList.toggle('active');
        }
    </script>
</body>

</html>
