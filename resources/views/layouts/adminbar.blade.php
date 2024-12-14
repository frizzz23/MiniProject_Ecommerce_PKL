<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
           
            <a href="{{ route('dashboard.index') }}" class="text-nowrap logo-img">
                <img src="{{ asset('style/src/assets/images/logos/dark-logo.svg') }}" width="180"
                    alt="" />
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
                            <i class="fa-solid fa-ticket"></i>
                        </span>
                        <span class="hide-menu">Voucher</span>
                    </a>
                </li>
                <li class="sidebar-item my-2">
                    <a class="sidebar-link" href="{{ route('admin.brands.index') }}" aria-expanded="false">
                        <span>
                            <i class="fa-solid fa-tag"></i>
                        </span>
                        <span class="hide-menu">Brand</span>
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
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
</aside>