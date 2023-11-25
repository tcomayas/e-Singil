<!-- Sidebar -->
<style scoped>
    @import '~@fortawesome/fontawesome-free/css/all.min.css';

    .main-menu {
        height: 85vh;
        width: 9.6vw;
        transition: all 1s cubic-bezier(0.79, 0.33, 0.14, 0.53);

    }

    .btn-menu {
        padding: 0;
        margin: 0;
        text-align: center;
        margin-left: 15px;
    }

    aside {
        height: 89.5vh;
        padding: 5px;
        box-shadow: 10px 0px 17px -9px rgba(0, 0, 0, 1) !important;

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
    }
</style>

<aside x-data="{ open: true }" class="text-black bg-blue-500">

    <button class="text-center text-white btn-menu" id="btn-menu">
        <!-- Add the icon here -->
        <i class="fa-solid fa-bars"></i>
        Menu
    </button>

    <nav class="main-menu" id="main-menu">
        <ul class="text-white">
            <li class="px-4 py-2"><a href="/debtor" class="block"><i class="fa-solid fa-chart-simple"></i>Dashboard</a>
            </li>
            <li class="px-4 py-2"><a href="/profile/show" class="block"><i class="fa-solid fa-user"></i>Profile</a>
            </li>
            <li class="px-4 py-2"><a href="/cart" class="block"><i class="fa-solid fa-shopping-cart"></i>Cart</a>
            </li>
            <li class="px-4 py-2"><a href="/debtor-history" class="block"><i
                        class="fa-solid fa-history"></i>History</a></li>
        </ul>
    </nav>

    <script>
        const btnMenu = document.querySelector('#btn-menu'),
            mainMenu = document.querySelector('#main-menu');

        btnMenu.addEventListener('click', () => {
            if (mainMenu.style.display === 'none' || mainMenu.style.display === '') {
                mainMenu.style.display = 'block';
            } else {
                mainMenu.style.display = 'none';
            }
        });
    </script>
</aside>
