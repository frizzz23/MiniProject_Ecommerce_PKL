<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Zen Tech</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
        <div id="sidebarOverlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-40">

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
</body>

</html>
