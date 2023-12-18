<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/stickybits@3.7.7/dist/stickybits.min.js"></script>

    <style>
        .nav-wrapper {
            width: 240px;
        }

        @media (max-width: 768px) {
            .nav-wrapper {
                width: 100%;
            }

            .nav-wrapper ul {
                padding: 0;
            }

            .nav-wrapper li {
                margin-bottom: 10px;
            }
        }
    </style>

    <script>
        const axios = require('axios');
        const tailwind = {};
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
</head>

<body>

    @if (!request()->is('login', 'register'))
        <nav class="flex items-center justify-between shadow-md shadow-gray-400">
            <a href="/">
                <img class="w-24 mx-5" src="{{ asset('images/logo.png') }}" alt="">
            </a>
            <ul class="flex mr-6 space-x-6">
                @auth
                    <div class="flex flex-row text-lg">
                        <div class="relative inline-block text-left">
                            <div>
                                @php
                                    $var = 0;
                                    foreach ($notifs as $not) {
                                        if ($not->status == 'unread') {
                                            $var += 1;
                                        }
                                    }
                                @endphp
                                <button type="button"
                                    class="inline-flex w-full justify-center gap-x-1.5 rounded-md border-none px-3 py-2 text-sm font-semibold text-gray-900 hover:bg-gray-50"
                                    id="menu-button" aria-expanded="true" aria-haspopup="true">
                                    <i
                                        @if ($var > 0) class="text-orange-400 fa-solid fa-bell" @else
                                        class="fa-regular fa-bell" @endif></i></button>
                            </div>

                            <div class="absolute right-0 z-10 hidden w-56 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1"
                                id="notif" style="max-height: 400px; overflow-y: scroll;">
                                <div class="p-1" style="position: relative;" role="none">
                                    <form method="POST" action="/notification/clear">
                                        @csrf
                                        <button type="submit" style="font-size: 14px;" class="mb-4">Read
                                            All</button>
                                    </form>
                                    <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                                    @foreach ($notifs as $notif)
                                        <div style="border-bottom: 1px solid gray;"
                                            @if ($notif->status == 'unread') class="font-bold text-dark"
                                            @else
                                            class="text-gray" @endif>
                                            <span style="font-size: 14px; ">{{ $notif->message }}</span>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>

                        <li x-data="{ open: false }" class="relative">
                            <div class="flex gap-1">
                                <button @click="open = !open"
                                    class="inline-flex px-4 rounded-md text-dark focus:outline-none focus:border-blue-300 focus:shadow-outline-blue hover:text-blue-500">
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
                                <a href="/users/listings/manage" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
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
                    </div>
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

        <div class="fixed hidden menu-btn" onclick="toggleMenu()">
            <i class="fas fa-bars"></i>
        </div>

        <div class="flex gap-5">
            <nav class="items-center w-40 p-5 text-white bg-blue-500 border-black shadow-md shadow-gray-400 nav-wrapper"
                style="height: 87.5vh !important; box-shadow: 10px 0px 17px -9px rgba(0, 0, 0, 1); !important;">
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
                            <a href="/users/listings/inventory" class="flex items-center text-dark hover:text-gray-300">
                                <span class="mr-2"><i class="fas fa-boxes"></i></span> INVENTORY
                            </a>
                        </li>
                        <li class="mb-4">
                            <a href="/pending">
                                <i class="fa-solid fa-clock-rotate-left"></i> <span>PENDING</span>
                            </a>
                        </li>
                        <li class="mb-4">
                            <a href="/debtor-profile">
                                <i class="fa-solid fa-people-group"></i> <span>DEBTORS</span>
                            </a>
                        </li>
                        <li class="mb-4">
                            <a href="/history" class="flex items-center text-dark hover:text-gray-300">
                                <span class="mr-2"><i class="fa-solid fa-list-check"></i></span> HISTORY
                            </a>
                        </li>
                    @else
                        <li class="mb-4">
                            <a href="/register" class="hover:text-laravel"><i class="fa-solid fa-user-plus"></i>
                                Register</a>
                        </li>
                        <li>
                            <a href="/login" class="hover:text-laravel"><i
                                    class="fa-solid fa-arrow-right-to-bracket"></i>
                                Login</a>
                        </li>
                    @endauth

                    <li class="mb-4">
                        <a href="/listings/product" class="flex items-center text-dark hover:text-gray-300">
                            <span class="mr-2"><i class="fas fa-box"></i></span> PRODUCTS
                        </a>
                    </li>

                    <li class="mb-4">
                        <a href="/sales" class="flex items-center text-dark hover:text-gray-300">
                            <span class="mr-2"><i class="fa-solid fa-peso-sign"></i></span> SALES
                        </a>
                    </li>
                </ul>
            </nav>
    @endif
    </nav>


    <main class="w-full">
        {{ $slot }}
    </main>
    @if (!request()->is('login', 'register', 'debtor-payment', 'debtor-profile', 'pending'))
        <footer
            class="fixed bottom-0 left-0 flex items-center justify-start w-full h-24 mt-24 font-bold opacity-90 md:justify-center">
            <a href="/users/listings/create"
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

        document.querySelector('#menu-button').addEventListener('click', function() {
            document.querySelector('#notif').classList.toggle('hidden');
        });
    </script>

</body>

</html>
