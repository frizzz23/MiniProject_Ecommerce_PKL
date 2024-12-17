<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">

            <a href="{{ route('dashboard.index') }}" class=" flex justify-center items-center gap-2 text-nowrap logo-img">
                <img src="{{ asset('loading/logo.png') }}" width="50" height="50" alt="" />
                <h5 class="font-bold text-3xl text-gray-700 ">Zen <span class="text-[#5D87FF]">Tech</span></h5>
            </a>

            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>

        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">

                <li class="sidebar-item my-2">
                    <a class="sidebar-link " href="{{ route('dashboard.index') }}" aria-expanded="false">
                        <span>
                            <i class="fa-solid fa-gauge"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item my-2">
                    <a class="sidebar-link " href="{{ route('admin.users.index') }}" aria-expanded="false">
                        <span>
                            <i class="fa-solid fa-users"></i>
                        </span>
                        <span class="hide-menu">User</span>
                    </a>
                </li>

                {{-- dropdown produk --}}
                <div class="">
                    <button id="accountMenuToggle"
                        class="w-full flex items-center justify-between {{ request()->routeIs('admin.products.index') ||
                        request()->routeIs('admin.categories.index') ||
                        request()->routeIs('admin.brands.index')
                            ? 'text-white bg-[#5D87FF] hover:bg-[#5D87FF]'
                            : 'text-[#2A3547]' }} hover:text-[#5D87FF] space-x-2 my-2 p-[10px] rounded-md hover:bg-[rgba(219,234,254,0.5)] group">
                        <div class="flex items-center">
                            <span
                                style="color: {{ request()->routeIs('admin.products.index') ||
                                request()->routeIs('admin.categories.index') ||
                                request()->routeIs('admin.brands.index')
                                    ? '#ffffff'
                                    : '' }};"
                                class="hove">
                                <i class="fa-solid fa-shop"></i>
                            </span>

                            <span class="ml-4">Product</span>
                        </div>
                        <svg id="accountMenuChevron" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24"
                            style="fill: {{ request()->routeIs('admin.products.index') ||
                            request()->routeIs('admin.categories.index') ||
                            request()->routeIs('admin.brands.index')
                                ? '#ffffff'
                                : ' ' }}; 
                                    transition: transform 0.3s; 
                                    transform: {{ request()->routeIs('admin.products.index') ||
                                    request()->routeIs('admin.categories.index') ||
                                    request()->routeIs('admin.brands.index')
                                        ? 'rotate(180deg)'
                                        : 'rotate(0deg)' }};"
                            class="group-hover:fill-[#5D87FF]">
                            <path d="M16.293 9.293 12 13.586 7.707 9.293l-1.414 1.414L12 16.414l5.707-5.707z">
                            </path>
                        </svg>
                    </button>

                    <div id="accountSubMenu"
                        class="{{ request()->routeIs('admin.products.index') ||
                        request()->routeIs('admin.categories.index') ||
                        request()->routeIs('admin.brands.index')
                            ? ''
                            : 'hidden' }} pl-4 space-y-2 mt-2">
                        <a href="{{ route('admin.products.index') }}"
                            class="block text-sm  p-2 {{ request()->routeIs('admin.products.index')
                                ? 'text-blue-600 font-semibold'
                                : 'text-gray-700 hover:text-blue-600' }}">
                            <span>
                                <i class="fa-solid fa-circle-chevron-right"></i>
                            </span>

                            <span class="ml-4">List Produk</span>
                        </a>
                        <a href="{{ route('admin.categories.index') }}"
                            class="block text-sm  p-2 {{ request()->routeIs('admin.categories.index')
                                ? 'text-blue-600 font-semibold'
                                : 'text-gray-700 hover:text-blue-600' }}">
                             <span>
                                <i class="fa-solid fa-circle-chevron-right"></i>
                            </span>

                            <span class="ml-4">List Katgeori</span>
                        </a>
                        <a href="{{ route('admin.brands.index') }}"
                            class="block text-sm  p-2 {{ request()->routeIs('admin.brands.index')
                                ? 'text-blue-600 font-semibold'
                                : 'text-gray-700 hover:text-blue-600' }}">
                             <span>
                                <i class="fa-solid fa-circle-chevron-right"></i>
                            </span>

                            <span class="ml-4">List Brand</span>
                        </a>
                    </div>
                </div>
                <li class="sidebar-item my-2">
                    <a class="sidebar-link" href="{{ route('admin.discount.index') }}" aria-expanded="false">
                        <span>
                            <i class="fa-solid fa-ticket"></i>
                        </span>
                        <span class="hide-menu">Voucher</span>
                    </a>
                </li>
                <li class="sidebar-item my-2">
                    <a class="sidebar-link" href="{{ route('admin.orders.index') }}" aria-expanded="false">
                        <span>

                            <i class="fa-solid fa-dolly"></i>
                        </span>
                        <span class="hide-menu">Order</span>
                    </a>
                </li>
                <li class="sidebar-item my-2">
                    <a class="sidebar-link" href="{{ route('admin.reviews.index') }}" aria-expanded="false">
                        <span>
                            <i class="fa-solid fa-comments"></i>
                        </span>
                        <span class="hide-menu">Review</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
</aside>

<script>
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
