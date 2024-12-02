<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            @if (Auth::user()->hasRole('admin'))
            <a href="{{ route('dashboard.index') }}" class="text-nowrap logo-img">
                <img src="{{ asset('style/src/assets/images/logos/dark-logo.svg') }}" width="180"
                    alt="" />
            </a>
            @endif
            @if (Auth::user()->hasRole('user'))
            <a href="{{ route('home-page') }}" class="text-nowrap logo-img">
                <img src="{{ asset('style/src/assets/images/logos/dark-logo.svg') }}" width="180"
                    alt="" />
            </a>
            @endif
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
            
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                @if (Auth::user()->hasRole('admin'))
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
               
                <li class="sidebar-item my-2">
                    <a class="sidebar-link" href="{{ route('admin.products.index') }}" aria-expanded="false">
                        <span>
                            <i class="fa-solid fa-shop"></i>
                        </span>
                        <span class="hide-menu">Product</span>
                    </a>
                </li>
                <li class="sidebar-item my-2">
                    <a class="sidebar-link" href="{{ route('admin.discount.index') }}" aria-expanded="false">
                        <span>
                            <i class="fa-solid fa-shop"></i>
                        </span>
                        <span class="hide-menu">Discount</span>
                    </a>
                </li>
                <li class="sidebar-item my-2">
                    <a class="sidebar-link" href="{{ route('admin.categories.index') }}" aria-expanded="false">
                        <span>
                            <i class="fa-solid fa-list"></i>
                        </span>
                        <span class="hide-menu">Category</span>
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
                <li class="sidebar-item my-2">
                    <a class="sidebar-link" href="{{ route('profile.edit') }}" aria-expanded="false">
                        <span>
                            <i class="fa-regular fa-address-card"></i>
                        </span>
                        <span class="hide-menu">My Profile</span>
                    </a>
                </li>
                @endif
                @if (Auth::user()->hasRole('user'))
                <li class="sidebar-item my-2">
                    <a class="sidebar-link" href="{{ route('profile.edit') }}" aria-expanded="false">
                        <span>
                            <i class="fa-regular fa-address-card"></i>
                        </span>
                        <span class="hide-menu">My Profile</span>
                    </a>
                </li>
                <li class="sidebar-item my-2">
                    <a class="sidebar-link" href="{{ route('user.carts.index') }}" aria-expanded="false">
                        <span>
                            <i class="fa-solid fa-cart-shopping"></i>
                        </span>
                        <span class="hide-menu">My Cart</span>
                    </a>
                </li>
                <li class="sidebar-item my-2">
                    <a class="sidebar-link" href="{{ route('user.orders.index') }}" aria-expanded="false">
                        <span>
                            <i class="fa-solid fa-shop"></i>
                        </span>
                        <span class="hide-menu">My Order</span>
                    </a>
                </li>
                <li class="sidebar-item my-2">
                    <a class="sidebar-link" href="{{ route('user.addresses.index') }}" aria-expanded="false">
                        <span>
                            <i class="fa-solid fa-map-location-dot"></i>
                        </span>
                        <span class="hide-menu">My Address</span>
                    </a>
                </li>
                
                @endif
                
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
</aside>