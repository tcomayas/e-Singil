<!-- Sidebar -->
<style scoped>
    @import '~@fortawesome/fontawesome-free/css/all.min.css';

    .main-menu {
        height: 85vh;
        width: 9.6vw;
        transition: all 1s cubic-bezier(0.79, 0.33, 0.14, 0.53);
        font-size: 14px;
    }

    nav ul li a:active {
        background-color: white;
        color: black;
    }

    .btn-menu {
        padding: 0;
        margin: 0;
        text-align: center;
        margin-left: 15px;
    }

    a:visited {
        background-color: white !important;
    }

    aside {
        height: 89.5vh;
        padding: 5px;
        box-shadow: 10px 0px 17px -9px rgba(0, 0, 0, 1) !important;
    }

    .active-link {
        background-color: white;
        color: black;
    }

    @media (max-width: 640px) {

        /* For small screens, show only the menu button */
        .main-menu {
            width: 10vw;
            top: 0;
            left: 0;
            display: none;
            /* You can customize the background color */
        }

        .main-menu ul li {
            display: hidden;
        }

        .main-menu ul li a {
            font-size: 12px;
        }
    }
</style>

<aside x-data="{ open: true }" class="bg-blue-500 active:bg-white">

    <button type="submit" class="text-center text-white btn-menu" id="btn-menu">
        <i class="fa-solid fa-bars"></i>
        Menu
    </button>

    <nav class="mt-5 main-menu" id="main-menu">
        <ul class="text-white ">
            <li class="px-4">
                <a href="/debtor" class="block py-2 text-white bg-gray-900 rounded-md" id="dashboard"
                    aria-current="page">
                    <i class="fa-solid fa-chart-simple"></i> Dashboard
                </a>
            </li>
            <li class="px-4 active:bg-white active:text-black {{ request()->is('profile/show') ? 'active' : '' }}">
                <a href="/profile/show" class="py-2 text-white bg-gray-900 rounded-md " id="dashboard"
                    aria-current="page">
                    <i class="fa-solid fa-user"></i> Profile
                </a>
            </li>
            <li class="px-4">
                <a href="/cart" class="block py-2 font-medium text-white bg-gray-900 rounded-md">
                    <i class="fa-solid fa-shopping-cart"></i> Cart
                </a>
            </li>
            <li class="px-4" :class="{ 'active': $route.path === '/debtor-history' }">
                <a href="/debtor-history" class="block py-2 font-medium text-white bg-gray-900 rounded-md">
                    <i class="fa-solid fa-history"></i> History
                </a>
            </li>

            <li class="px-4">
                <a href="/debtor-notification" class="block py-2 font-medium text-white bg-gray-900 rounded-md">
                    <i class="fa-solid fa-bell"></i> Notification
                </a>
            </li>
            <li class="px-4">
                <a href="/pay" class="block py-2 font-medium text-white bg-gray-900 rounded-md">
                    <i class="fa-regular fa-credit-card"></i> Pay
                </a>
            </li>
        </ul>
    </nav>


    <script>
        const btnMenu = document.querySelector('#btn-menu'),
            mainMenu = document.querySelector('#main-menu');

        btnMenu.addEventListener('click', () => {
            if (mainMenu.style.display === 'none' || mainMenu.style.display === '') {
                mainMenu.style.display = 'block';
                mainMenu.style.width = '120px';
            } else {
                mainMenu.style.display = 'none';
            }
        });
    </script>
</aside>
