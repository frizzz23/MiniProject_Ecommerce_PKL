<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Zen Tech</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('img/logoo.png') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- font poopins -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <style>
        * {
            font-family: "Poppins", sans-serif;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="bg-gray-100 text-gray-800 font-sans">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        @include('layouts.userbar')
        <!-- Main Content Container -->
        <div class="flex-1 flex flex-col overflow-hidden">

            <!-- Scrollable Main Content -->
            <main class="flex-1 overflow-y-auto p-8 bg-gray-100">

                @yield('main')

            </main>
        </div>

        <!-- Mobile Hamburger Button -->
        <button id="mobileSidebarToggle"
            class="fixed top-7 left-0 z-0 md:hidden w-5 h-10 rounded-r-lg bg-white shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-800" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- Sidebar Overlay -->
        <div id="sidebarOverlay" class="hidden fixed h-full inset-0 bg-black bg-opacity-50 z-40">

        </div>
    </div>

    <script>
        // Script untuk toggle sidebar tetap sama
        const mobileSidebarToggle = document.getElementById('mobileSidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        mobileSidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            sidebarOverlay.classList.toggle('hidden');
        });

        sidebarOverlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        });

        // Script untuk expandable menu Akun Saya
        const accountMenuToggle = document.getElementById('accountMenuToggle');
        const accountSubMenu = document.getElementById('accountSubMenu');
        const accountMenuChevron = document.getElementById('accountMenuChevron');

        accountMenuToggle.addEventListener('click', () => {
            // Toggle submenu
            accountSubMenu.classList.toggle('hidden');

            // Rotate chevron
            accountMenuChevron.style.transform = accountSubMenu.classList.contains('hidden') ?
                'rotate(0deg)' :
                'rotate(180deg)';
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
