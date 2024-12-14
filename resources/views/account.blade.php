<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800 font-sans">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed md:sticky top-0 left-0 w-64 md:w-72 h-screen md:h-auto overflow-y-auto bg-white shadow p-4 z-50 md:z-0 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out">
            <div class="text-center mb-6">
                <div class="flex justify-center items-center mb-4">
                    @if (Auth::user()->image)
                        <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Profile Picture"
                            style="width: 120px; height: 120px; object-fit: cover; object-position: center; border-radius: 50%;"
                            class="rounded-full">
                    @else
                        <img src="{{ asset('style/src/assets/images/profile/user-1.jpg') }}"
                            alt="Default Profile Picture"
                            style="width: 120px; height: 120px; object-fit: cover; object-position: center; border-radius: 50%;"
                            class="rounded-full">
                    @endif
                </div>
                <h2 class="text-lg font-semibold mt-4">{{ Auth::user()->name ?? 'User' }}</h2>
                <p class="text-sm text-gray-500">{{ Auth::user()->email ?? '-' }}</p>
            </div>
            <nav class="space-y-4">
                <hr class="border-gray-300 my-4">
                <a href="{{ route('user.orders.index') }}"
                    class="flex items-center text-gray-600 hover:text-blue-600 space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        style="fill: rgba(102, 110, 241, 1);">
                        <path
                            d="M21 4H2v2h2.3l3.521 9.683A2.004 2.004 0 0 0 9.7 17H18v-2H9.7l-.728-2H18c.4 0 .762-.238.919-.606l3-7A.998.998 0 0 0 21 4z">
                        </path>
                        <circle cx="10.5" cy="19.5" r="1.5"></circle>
                        <circle cx="16.5" cy="19.5" r="1.5"></circle>
                    </svg>
                    <span>My orders</span>
                </a>
                <a href="#" class="flex items-center text-gray-600 hover:text-blue-600 space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        style="fill: rgba(102, 110, 241, 1);">
                        <path
                            d="m6.516 14.323-1.49 6.452a.998.998 0 0 0 1.529 1.057L12 18.202l5.445 3.63a1.001 1.001 0 0 0 1.517-1.106l-1.829-6.4 4.536-4.082a1 1 0 0 0-.59-1.74l-5.701-.454-2.467-5.461a.998.998 0 0 0-1.822 0L8.622 8.05l-5.701.453a1 1 0 0 0-.619 1.713l4.214 4.107zm2.853-4.326a.998.998 0 0 0 .832-.586L12 5.43l1.799 3.981a.998.998 0 0 0 .832.586l3.972.315-3.271 2.944c-.284.256-.397.65-.293 1.018l1.253 4.385-3.736-2.491a.995.995 0 0 0-1.109 0l-3.904 2.603 1.05-4.546a1 1 0 0 0-.276-.94l-3.038-2.962 4.09-.326z">
                        </path>
                    </svg>
                    <span>Reviews</span>
                </a>
                <a href="{{ route('user.addresses.index') }}"
                    class="flex items-center text-gray-600 hover:text-blue-600 space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        style="fill: rgba(102, 110, 241, 1);">
                        <path
                            d="M19.15 8a2 2 0 0 0-1.72-1H15V5a1 1 0 0 0-1-1H4a2 2 0 0 0-2 2v10a2 2 0 0 0 1 1.73 3.49 3.49 0 0 0 7 .27h3.1a3.48 3.48 0 0 0 6.9 0 2 2 0 0 0 2-2v-3a1.07 1.07 0 0 0-.14-.52zM15 9h2.43l1.8 3H15zM6.5 19A1.5 1.5 0 1 1 8 17.5 1.5 1.5 0 0 1 6.5 19zm10 0a1.5 1.5 0 1 1 1.5-1.5 1.5 1.5 0 0 1-1.5 1.5z">
                        </path>
                    </svg>
                    <span>Delivery addresses</span>
                </a>
                <a href="#" class="flex items-center text-gray-600 hover:text-blue-600 space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        style="fill: rgba(102, 110, 241, 1)">
                        <path
                            d="M12 9a3.02 3.02 0 0 0-3 3c0 1.642 1.358 3 3 3 1.641 0 3-1.358 3-3 0-1.641-1.359-3-3-3z">
                        </path>
                        <path
                            d="M12 5c-7.633 0-9.927 6.617-9.948 6.684L1.946 12l.105.316C2.073 12.383 4.367 19 12 19s9.927-6.617 9.948-6.684l.106-.316-.105-.316C21.927 11.617 19.633 5 12 5zm0 12c-5.351 0-7.424-3.846-7.926-5C4.578 10.842 6.652 7 12 7c5.351 0 7.424 3.846 7.926 5-.504 1.158-2.578 5-7.926 5z">
                        </path>
                    </svg>
                    <span>Recently viewed</span>
                </a>
                <a href="#" class="flex items-center text-gray-600 hover:text-blue-600 space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        style="fill: rgba(102, 110, 241, 1);">
                        <path
                            d="M20.205 4.791a5.938 5.938 0 0 0-4.209-1.754A5.906 5.906 0 0 0 12 4.595a5.904 5.904 0 0 0-3.996-1.558 5.942 5.942 0 0 0-4.213 1.758c-2.353 2.363-2.352 6.059.002 8.412L12 21.414l8.207-8.207c2.354-2.353 2.355-6.049-.002-8.416z">
                        </path>
                    </svg>
                    <span>Favorite items</span>
                </a>
                <hr class="border-gray-700 my-4">
                <a href="#" class="flex items-center text-red-400 hover:text-red-600 space-x-2"
                    onclick="document.getElementById('logout-form').submit();">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        style="fill: rgba(102, 110, 241, 1);">
                        <path d="M16 13v-2H7V8l-5 4 5 4v-3z"></path>
                        <path
                            d="M20 3h-9c-1.103 0-2 .897-2 2v4h2V5h9v14h-9v-4H9v4c0 1.103.897 2 2 2h9c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2z">
                        </path>
                    </svg>
                    <span>Logout</span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="my-2">
                    @csrf
                    <button type="submit" class="hidden">Logout</button>
                </form>
            </nav>
        </aside>

        <!-- Main Content Container -->
        <div class="flex-1 flex flex-col overflow-hidden">

            <!-- Scrollable Main Content -->
            <main class="flex-1 overflow-y-auto p-8 bg-gray-100">
                <!-- Breadcrumbs -->
                <nav class="mb-4 flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                        <li class="inline-flex items-center">
                            <a href="{{ route('landing-page') }}"
                                class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-blue-600">
                                <svg class="me-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
                                </svg>
                                Home
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="mx-1 h-4 w-4 text-gray-400 rtl:rotate-180" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m9 5 7 7-7 7" />
                                </svg>
                                <a href="{{ route('landing-page') }}"
                                    class="ms-1 text-sm font-medium text-gray-600 hover:text-blue-600 md:ms-2">My
                                    account</a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="mx-1 h-4 w-4 text-gray-400 rtl:rotate-180" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m9 5 7 7-7 7" />
                                </svg>
                                <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">Account</span>
                            </div>
                        </li>
                    </ol>
                </nav>

                <h2 class="mb-4 text-xl font-semibold text-gray-800 sm:text-2xl md:mb-6">
                    General overview
                </h2>
                <span class="flex items-center mb-11">
                    <span class="h-px flex-1 bg-gray-300"></span>
                </span>

                <!-- Top Stats -->
                <div class="grid grid-cols-1 max-sm:grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-6 -mt-4">
                    <div class="bg-white p-4 rounded-lg text-center shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            style="fill: rgba(102, 110, 241, 1);" class="w-12 h-12 mb-3 inline-block">
                            <path
                                d="M20.205 4.791a5.938 5.938 0 0 0-4.209-1.754A5.906 5.906 0 0 0 12 4.595a5.904 5.904 0 0 0-3.996-1.558 5.942 5.942 0 0 0-4.213 1.758c-2.353 2.363-2.352 6.059.002 8.412L12 21.414l8.207-8.207c2.354-2.353 2.355-6.049-.002-8.416z">
                            </path>
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-700">Favorite products</h3>
                        <p class="text-2xl font-bold text-gray-900">455</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg text-center shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            style="fill: rgba(102, 110, 241, 1);" class="w-12 h-12 mb-3 inline-block">
                            <circle cx="10.5" cy="19.5" r="1.5"></circle>
                            <circle cx="17.5" cy="19.5" r="1.5"></circle>
                            <path d="m14 13.99 4-5h-3v-4h-2v4h-3l4 5z"></path>
                            <path
                                d="M17.31 15h-6.64L6.18 4.23A2 2 0 0 0 4.33 3H2v2h2.33l4.75 11.38A1 1 0 0 0 10 17h8a1 1 0 0 0 .93-.64L21.76 9h-2.14z">
                            </path>
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-700">Total orders</h3>
                        <p class="text-2xl font-bold text-gray-900">124</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg text-center shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            style="fill: rgba(102, 110, 241, 1);" class="w-12 h-12 mb-3 inline-block">
                            <path
                                d="M21.947 9.179a1.001 1.001 0 0 0-.868-.676l-5.701-.453-2.467-5.461a.998.998 0 0 0-1.822-.001L8.622 8.05l-5.701.453a1 1 0 0 0-.619 1.713l4.213 4.107-1.49 6.452a1 1 0 0 0 1.53 1.057L12 18.202l5.445 3.63a1.001 1.001 0 0 0 1.517-1.106l-1.829-6.4 4.536-4.082c.297-.268.406-.686.278-1.065z">
                            </path>
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-700">Reviews added</h3>
                        <p class="text-2xl font-bold text-gray-900">1,285</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg text-center shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            style="fill: rgba(102, 110, 241, 1);" class="w-12 h-12 mb-3 inline-block">
                            <path
                                d="M21 6h-5v2h4v9H4V8h5v3l5-4-5-4v3H3a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1z">
                            </path>
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-700">Product returns</h3>
                        <p class="text-2xl font-bold text-gray-900">2</p>
                    </div>
                </div>

                <!-- Account Data -->
                <div class="bg-white p-6 rounded-lg mb-10 shadow">
                    <!-- Mobile Hamburger Button -->
                   

                    <h2 class="flex text-2xl justify-center font-semibold text-gray-800 mb-4">Account data</h2>
                    <span class="flex items-center mb-4">
                        <span class="h-px flex-1 bg-gray-300"></span>
                    </span>
                    {{-- <div class="flex space-x-4">
                        @if (Auth::user()->image)
                            <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Profile Picture"
                                style="width: 100px; height: 100px; object-fit: cover; object-position: center;">
                        @else
                            <img src="{{ asset('style/src/assets/images/profile/user-1.jpg') }}"
                                alt="Default Profile Picture"
                                style="width: 100px; height: 100px; object-fit: cover; object-position: center;">
                        @endif

                        <div>
                            <h2
                                class="flex items-center mt-8 text-xl font-bold leading-none text-gray-800 sm:text-2xl">
                                {{ Auth::user()->name ?? 'User' }}
                            </h2>
                        </div>
                    </div> --}}
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <p class="text-gray-600 mb-2"><span class="font-bold text-gray-800">Name
                                </span><br> {{ Auth::user()->name ?? '-' }} </p>
                            <p class="text-gray-600 mb-2"><span class="font-bold text-gray-800">Email
                                    Address</span><br> {{ Auth::user()->email ?? '-' }} </p>
                            <p class="text-gray-600 mb-2"><span class="font-bold text-gray-800">Delivery
                                    Address</span><br>{{ Auth::user()->address ?? '-' }}</p>
                            <p class="text-gray-600 mb-2"><span class="font-bold text-gray-800">Phone
                                    Number</span><br>{{ Auth::user()->no_telepon ?? '-' }}</p>
                            <a href=""
                                class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-400 inline-block">
                                Edit your data
                            </a>
                        </div>
                        <div>
                            <p class="text-gray-600 mb-2"><span class="font-bold text-gray-800">Favorite pick-up
                                    point</span><br>Herald Square, 2, New York, United States of America</p>
                            <p class="text-gray-600 mb-2"><span class="font-bold text-gray-800">Home
                                    Address</span><br>2 Miles Drive, NJ 071, New York, United States of America</p>
                            <p class="text-gray-600 mb-2"><span class="font-bold text-gray-800">My
                                    Companies</span><br>FLOWBITE LLC, Fiscal code: 18673557</p>
                            <hr class="border-gray-300 my-4">
                        </div>
                    </div>
                </div>

            </main>
        </div>

        <button id="mobileSidebarToggle" class="fixed top-7 left-0 z-0 md:hidden w-5 h-10 ml-1 rounded-r-lg bg-white shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-800" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- Sidebar Overlay -->
        <div id="sidebarOverlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-40">

        </div>
    </div>

    <script>
        // Sidebar toggle script remains the same
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
    </script>
</body>

</html>
