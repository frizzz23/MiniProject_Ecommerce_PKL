<aside id="sidebar"
    class="fixed md:sticky top-0 left-0 w-64 md:w-72  overflow-y-auto max-h-screen md:h-screen  bg-white shadow-sm p-4 z-50 md:z-0 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out"
    style="scrollbar-width: none;
            -ms-overflow-style: none; 
            ::-webkit-scrollbar { display: none; }">
    <div class="text-center mb-6">
        <div class="flex justify-center items-center mb-4">
            @if (Auth::user()->image)
                <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Profile Picture"
                    style="width: 85px; height: 85px; object-fit: cover; object-position: center; border-radius: 50%;"
                    class="rounded-full">
            @else
                <img src="{{ asset('style/src/assets/images/profile/user-1.jpg') }}" alt="Default Profile Picture"
                    style="width: 85px; height: 85px; object-fit: cover; object-position: center; border-radius: 50%;"
                    class="rounded-full">
            @endif
        </div>
        <h2 class="text-lg font-semibold mt-4">{{ Auth::user()->name ?? 'User' }}</h2>
        <p class="text-sm text-gray-500">{{ Auth::user()->email ?? '-' }}</p>
    </div>
    <nav class="space-y-4">
        <hr class="border-gray-300 my-4">
        <div>
            <button id="accountMenuToggle"
                class="w-full flex items-center justify-between {{ request()->routeIs('user.profile.profile') ||
                request()->routeIs('user.profile.password') ||
                request()->routeIs('user.profile.delete')
                    ? 'text-blue-600'
                    : 'text-gray-600' }} hover:text-blue-600 space-x-2 rounded">
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        style="fill: {{ request()->routeIs('user.profile.profile') ||
                        request()->routeIs('user.profile.password') ||
                        request()->routeIs('user.profile.delete')
                            ? 'rgba(37, 99, 235, 1)'
                            : 'rgba(102, 110, 241, 1)' }};">
                        <path
                            d="M12 2A10.13 10.13 0 0 0 2 12a10 10 0 0 0 4 7.92V20h.1a9.7 9.7 0 0 0 11.8 0h.1v-.08A10 10 0 0 0 22 12 10.13 10.13 0 0 0 12 2zM8.07 18.93A3 3 0 0 1 11 16.57h2a3 3 0 0 1 2.93 2.36 7.75 7.75 0 0 1-7.86 0zm9.54-1.29A5 5 0 0 0 13 14.57h-2a5 5 0 0 0-4.61 3.07A8 8 0 0 1 4 12a8.1 8.1 0 0 1 8-8 8.1 8.1 0 0 1 8 8 8 8 0 0 1-2.39 5.64z">
                        </path>
                        <path
                            d="M12 6a3.91 3.91 0 0 0-4 4 3.91 3.91 0 0 0 4 4 3.91 3.91 0 0 0 4-4 3.91 3.91 0 0 0-4-4zm0 6a1.91 1.91 0 0 1-2-2 1.91 1.91 0 0 1 2-2 1.91 1.91 0 0 1 2 2 1.91 1.91 0 0 1-2 2z">
                        </path>
                    </svg>
                    <span>Akun Saya</span>
                </div>
                <svg id="accountMenuChevron" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24"
                    style="fill: {{ request()->routeIs('user.profile.profile') ||
                    request()->routeIs('user.profile.password') ||
                    request()->routeIs('user.profile.delete')
                        ? 'rgba(37, 99, 235, 1)'
                        : 'rgba(102, 110, 241, 1)' }}; 
                            transition: transform 0.3s; 
                            transform: {{ request()->routeIs('user.profile.profile') ||
                            request()->routeIs('user.profile.password') ||
                            request()->routeIs('user.profile.delete')
                                ? 'rotate(180deg)'
                                : 'rotate(0deg)' }};">
                    <path d="M16.293 9.293 12 13.586 7.707 9.293l-1.414 1.414L12 16.414l5.707-5.707z"></path>
                </svg>
            </button>

            <div id="accountSubMenu"
                class="{{ request()->routeIs('user.profile.profile') ||
                request()->routeIs('user.profile.password') ||
                request()->routeIs('user.profile.delete')
                    ? ''
                    : 'hidden' }} pl-8 space-y-2 mt-2">
                <a href="{{ route('user.profile.profile') }}"
                    class="block text-sm {{ request()->routeIs('user.profile.profile')
                        ? 'text-blue-600 font-semibold'
                        : 'text-gray-700 hover:text-blue-600' }}">
                    Profile Saya
                </a>
                <a href="{{ route('user.profile.password') }}"
                    class="block text-sm {{ request()->routeIs('user.profile.password')
                        ? 'text-blue-600 font-semibold'
                        : 'text-gray-700 hover:text-blue-600' }}">
                    Ganti Password
                </a>
                <a href="{{ route('user.profile.delete') }}"
                    class="block text-sm {{ request()->routeIs('user.profile.delete')
                        ? 'text-blue-600 font-semibold'
                        : 'text-gray-700 hover:text-blue-600' }}">
                    Pengaturan Privasi
                </a>
            </div>
        </div>

        <!-- Sisa menu tetap sama -->
        <a href="{{ route('user.orders.index') }}"
            class="flex items-center {{ request()->routeIs('user.orders.index') ? 'text-blue-600' : 'text-gray-600' }} hover:text-blue-600 space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                style="fill: {{ request()->routeIs('user.orders.index') ? 'rgba(37, 99, 235, 1)' : 'rgba(102, 110, 241, 1)' }};">
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
            class="flex items-center {{ request()->routeIs('user.addresses.index') ? 'text-blue-600' : 'text-gray-600' }} hover:text-blue-600 space-x-2 ">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                style="fill:{{ request()->routeIs('user.addresses.index') ? 'rgba(37, 99, 235, 1)' : 'rgba(102, 110, 241, 1)' }};">
                <path
                    d="M19.15 8a2 2 0 0 0-1.72-1H15V5a1 1 0 0 0-1-1H4a2 2 0 0 0-2 2v10a2 2 0 0 0 1 1.73 3.49 3.49 0 0 0 7 .27h3.1a3.48 3.48 0 0 0 6.9 0 2 2 0 0 0 2-2v-3a1.07 1.07 0 0 0-.14-.52zM15 9h2.43l1.8 3H15zM6.5 19A1.5 1.5 0 1 1 8 17.5 1.5 1.5 0 0 1 6.5 19zm10 0a1.5 1.5 0 1 1 1.5-1.5 1.5 1.5 0 0 1-1.5 1.5z">
                </path>
            </svg>
            <span>Delivery addresses</span>
        </a>
        <a href="#" class="flex items-center text-gray-600 hover:text-blue-600 space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                style="fill: rgba(102, 110, 241, 1)">
                <path d="M12 9a3.02 3.02 0 0 0-3 3c0 1.642 1.358 3 3 3 1.641 0 3-1.358 3-3 0-1.641-1.359-3-3-3z">
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


