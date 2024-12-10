<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-gray-200 font-sans">
    <section class="py-8 antialiased md:py-8">
        <!-- Sidebar Overlay -->
        <div id="sidebarOverlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-40"></div>

        <div class="max-w-screen-lg px-6">
            <!-- Breadcrumbs -->
            <nav class="mb-4 flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="#"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary-600 dark:text-gray-400 dark:hover:text-white">
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
                            <a href="#"
                                class="ms-1 text-sm font-medium text-gray-700 hover:text-primary-600 dark:text-gray-400 dark:hover:text-white md:ms-2">My
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
                            <span
                                class="ms-1 text-sm font-medium text-gray-500 dark:text-gray-400 md:ms-2">Account</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <h2 class="mb-4 text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl md:mb-6">General overview
            </h2>
            <span class="flex items-center mb-4">
                <span class="h-px flex-1 bg-neutral-400"></span>
            </span>
        </div>

        <!-- Container -->
        <div class="min-h-screen p-6 flex">
            <!-- Mobile Hamburger Button -->
            <button id="mobileSidebarToggle" class="fixed top-4 left-4 z-50 md:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <!-- Sidebar -->
            <aside id="sidebar"
                class="fixed md:relative top-0 left-0 w-64 md:w-72 h-full md:h-auto transform -translate-x-full md:translate-x-0 bg-gray-800 p-4 z-50 md:z-0 transition-transform duration-300 ease-in-out md:sticky md:top-0">
                <div class="text-center mb-6">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Profile"
                        class="w-20 h-20 rounded-full mx-auto">
                    <h2 class="text-lg font-semibold mt-4">Jese Leos (Personal)</h2>
                    <p class="text-sm text-gray-400">jese@flowbite.com</p>
                </div>
                <nav class="space-y-4">
                    <hr class="border-gray-700 my-4">
                    <a href="#" class="flex items-center text-gray-300 hover:text-white space-x-2">
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
                    <a href="#" class="flex items-center text-gray-300 hover:text-white space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            style="fill: rgba(102, 110, 241, 1);">
                            <path
                                d="m6.516 14.323-1.49 6.452a.998.998 0 0 0 1.529 1.057L12 18.202l5.445 3.63a1.001 1.001 0 0 0 1.517-1.106l-1.829-6.4 4.536-4.082a1 1 0 0 0-.59-1.74l-5.701-.454-2.467-5.461a.998.998 0 0 0-1.822 0L8.622 8.05l-5.701.453a1 1 0 0 0-.619 1.713l4.214 4.107zm2.853-4.326a.998.998 0 0 0 .832-.586L12 5.43l1.799 3.981a.998.998 0 0 0 .832.586l3.972.315-3.271 2.944c-.284.256-.397.65-.293 1.018l1.253 4.385-3.736-2.491a.995.995 0 0 0-1.109 0l-3.904 2.603 1.05-4.546a1 1 0 0 0-.276-.94l-3.038-2.962 4.09-.326z">
                            </path>
                        </svg>
                        <span>Reviews</span>
                    </a>
                    <a href="#" class="flex items-center text-gray-300 hover:text-white space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            style="fill: rgba(102, 110, 241, 1);">
                            <path
                                d="M19.15 8a2 2 0 0 0-1.72-1H15V5a1 1 0 0 0-1-1H4a2 2 0 0 0-2 2v10a2 2 0 0 0 1 1.73 3.49 3.49 0 0 0 7 .27h3.1a3.48 3.48 0 0 0 6.9 0 2 2 0 0 0 2-2v-3a1.07 1.07 0 0 0-.14-.52zM15 9h2.43l1.8 3H15zM6.5 19A1.5 1.5 0 1 1 8 17.5 1.5 1.5 0 0 1 6.5 19zm10 0a1.5 1.5 0 1 1 1.5-1.5 1.5 1.5 0 0 1-1.5 1.5z">
                            </path>
                        </svg>
                        <span>Delivery addresses</span>
                    </a>
                    <a href="#" class="flex items-center text-gray-300 hover:text-white space-x-2">
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
                    <a href="#" class="flex items-center text-gray-300 hover:text-white space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            style="fill: rgba(102, 110, 241, 1);">
                            <path
                                d="M20.205 4.791a5.938 5.938 0 0 0-4.209-1.754A5.906 5.906 0 0 0 12 4.595a5.904 5.904 0 0 0-3.996-1.558 5.942 5.942 0 0 0-4.213 1.758c-2.353 2.363-2.352 6.059.002 8.412L12 21.414l8.207-8.207c2.354-2.353 2.355-6.049-.002-8.416z">
                            </path>
                        </svg>
                        <span>Favorite items</span>
                    </a>
                    <hr class="border-gray-700 my-4">
                    <a href="#" class="flex items-center text-red-400 hover:text-red-600 space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            style="fill: rgba(102, 110, 241, 1);">
                            <path d="M16 13v-2H7V8l-5 4 5 4v-3z"></path>
                            <path
                                d="M20 3h-9c-1.103 0-2 .897-2 2v4h2V5h9v14h-9v-4H9v4c0 1.103.897 2 2 2h9c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2z">
                            </path>
                        </svg>
                        <span>Log out</span>
                    </a>
                </nav>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 p-4">
                <!-- Top Stats -->
                <div class="grid grid-cols-4 gap-4 mb-6 -mt-4">
                    <div class="bg-gray-800 p-4 rounded-lg text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            style="fill: rgba(102, 110, 241, 1);" class="w-12 h-12 mb-3 inline-block">
                            <path
                                d="M20.205 4.791a5.938 5.938 0 0 0-4.209-1.754A5.906 5.906 0 0 0 12 4.595a5.904 5.904 0 0 0-3.996-1.558 5.942 5.942 0 0 0-4.213 1.758c-2.353 2.363-2.352 6.059.002 8.412L12 21.414l8.207-8.207c2.354-2.353 2.355-6.049-.002-8.416z">
                            </path>
                        </svg>
                        <h3 class="text-lg font-semibold">Favorite products</h3>
                        <p class="text-2xl font-bold">455</p>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            style="fill: rgba(102, 110, 241, 1);" class="w-12 h-12 mb-3 inline-block">
                            <circle cx="10.5" cy="19.5" r="1.5"></circle>
                            <circle cx="17.5" cy="19.5" r="1.5"></circle>
                            <path d="m14 13.99 4-5h-3v-4h-2v4h-3l4 5z"></path>
                            <path
                                d="M17.31 15h-6.64L6.18 4.23A2 2 0 0 0 4.33 3H2v2h2.33l4.75 11.38A1 1 0 0 0 10 17h8a1 1 0 0 0 .93-.64L21.76 9h-2.14z">
                            </path>
                        </svg>
                        <h3 class="text-lg font-semibold">Total orders</h3>
                        <p class="text-2xl font-bold">124</p>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            style="fill: rgba(102, 110, 241, 1);" class="w-12 h-12 mb-3 inline-block">
                            <path
                                d="M21.947 9.179a1.001 1.001 0 0 0-.868-.676l-5.701-.453-2.467-5.461a.998.998 0 0 0-1.822-.001L8.622 8.05l-5.701.453a1 1 0 0 0-.619 1.713l4.213 4.107-1.49 6.452a1 1 0 0 0 1.53 1.057L12 18.202l5.445 3.63a1.001 1.001 0 0 0 1.517-1.106l-1.829-6.4 4.536-4.082c.297-.268.406-.686.278-1.065z">
                            </path>
                        </svg>
                        <h3 class="text-lg font-semibold">Reviews added</h3>
                        <p class="text-2xl font-bold">1,285</p>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            style="fill: rgba(102, 110, 241, 1);" class="w-12 h-12 mb-3 inline-block">
                            <path
                                d="M21 6h-5v2h4v9H4V8h5v3l5-4-5-4v3H3a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1z">
                            </path>
                        </svg>
                        <h3 class="text-lg font-semibold">Product returns</h3>
                        <p class="text-2xl font-bold">2</p>
                    </div>
                    <section class="text-gray-600 body-font">
                </div>

                <!-- Account Data -->
                <div class="bg-gray-800 p-6 rounded-lg mb-10">
                    <h2 class="flex text-2xl justify-center font-semibold mb-4">Account data</h2>
                    <span class="flex items-center mb-4">
                        <span class="h-px flex-1 bg-gray-700"></span>
                    </span>
                    <div class="flex space-x-4">
                        <img class="h-16 w-16 rounded-lg"
                            src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/helene-engels.png"
                            alt="Helene avatar" />
                        <div>
                            <span
                                class="mb-2 inline-block rounded bg-blue-500 px-2 py-0.5 text-xs font-medium text-primary-800 dark:text-primary-300">
                                PRO Account </span>
                            <h2
                                class="flex items-center mb-6 text-xl font-bold leading-none text-gray-900 dark:text-white sm:text-2xl">
                                Helene Engels</h2>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <p class="text-gray-400 mb-2"><span class="font-bold text-white">Email
                                    Address</span><br>yourname@example.com</p>
                            <p class="text-gray-400 mb-2"><span class="font-bold text-white">Delivery
                                    Address</span><br>
                                <svg class="hidden h-5 w-5 shrink-0 text-gray-400 dark:text-gray-500 lg:inline"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                                </svg> Miles Drive, Newark, NJ 07103, California, USA
                            </p>
                            <p class="text-gray-400 mb-2"><span class="font-bold text-white">Phone
                                    Number</span><br>
                                +1234 567 890 / +12 345 678</p>
                            <p class="text-gray-400 mb-10"><span class="font-bold text-white">Country</span><br>
                                United States of America</p>
                            <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-500">Edit
                                your
                                data</button>
                        </div>
                        <div>
                            <p class="text-gray-400 mb-2"><span class="font-bold text-white">Favorite pick-up
                                    point</span>
                                <br><svg class="hidden h-5 w-5 shrink-0 text-gray-400 dark:text-gray-500 lg:inline"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 12c.263 0 .524-.06.767-.175a2 2 0 0 0 .65-.491c.186-.21.333-.46.433-.734.1-.274.15-.568.15-.864a2.4 2.4 0 0 0 .586 1.591c.375.422.884.659 1.414.659.53 0 1.04-.237 1.414-.659A2.4 2.4 0 0 0 12 9.736a2.4 2.4 0 0 0 .586 1.591c.375.422.884.659 1.414.659.53 0 1.04-.237 1.414-.659A2.4 2.4 0 0 0 16 9.736c0 .295.052.588.152.861s.248.521.434.73a2 2 0 0 0 .649.488 1.809 1.809 0 0 0 1.53 0 2.03 2.03 0 0 0 .65-.488c.185-.209.332-.457.433-.73.1-.273.152-.566.152-.861 0-.974-1.108-3.85-1.618-5.121A.983.983 0 0 0 17.466 4H6.456a.986.986 0 0 0-.93.645C5.045 5.962 4 8.905 4 9.736c.023.59.241 1.148.611 1.567.37.418.865.667 1.389.697Zm0 0c.328 0 .651-.091.94-.266A2.1 2.1 0 0 0 7.66 11h.681a2.1 2.1 0 0 0 .718.734c.29.175.613.266.942.266.328 0 .651-.091.94-.266.29-.174.537-.427.719-.734h.681a2.1 2.1 0 0 0 .719.734c.289.175.612.266.94.266.329 0 .652-.091.942-.266.29-.174.536-.427.718-.734h.681c.183.307.43.56.719.734.29.174.613.266.941.266a1.819 1.819 0 0 0 1.06-.351M6 12a1.766 1.766 0 0 1-1.163-.476M5 12v7a1 1 0 0 0 1 1h2v-5h3v5h7a1 1 0 0 0 1-1v-7m-5 3v2h2v-2h-2Z" />
                                </svg>Herald Square, 2, New York, United States of America
                            </p>
                            <p class="text-gray-400 mb-2"><span class="font-bold text-white">Home
                                    Address</span><br>
                                <svg class="hidden h-5 w-5 shrink-0 text-gray-400 dark:text-gray-500 lg:inline"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
                                </svg> 2 Miles Drive, NJ 071, New York, United States of America
                            </p>
                            <p class="text-gray-400 mb-2"><span class="font-bold text-white">My
                                    Companies</span><br>
                                FLOWBITE LLC, Fiscal code: 18673557</p>
                            <hr class="border-gray-700 my-4 max-h-px">
                        </div>

                    </div>
                </div>
            </main>
        </div>
        </div>

        <div id="deleteOrderModal" tabindex="-1" aria-hidden="true"
            class="fixed left-0 right-0 top-0 z-50 hidden h-modal w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0 md:h-full">
            <div class="relative h-full w-full max-w-md p-4 md:h-auto">
                <!-- Modal content -->
                <div class="relative rounded-lg bg-white p-4 text-center shadow dark:bg-gray-800 sm:p-5">
                    <button type="button"
                        class="absolute right-2.5 top-2.5 ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="deleteOrderModal">
                        <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div
                        class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-gray-100 p-2 dark:bg-gray-700">
                        <svg class="h-8 w-8 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                        </svg>
                        <span class="sr-only">Danger icon</span>
                    </div>
                    <p class="mb-3.5 text-gray-900 dark:text-white"><a href="#"
                            class="font-medium text-primary-700 hover:underline dark:text-primary-500">@heleneeng</a>,
                        are you sure you want to delete this order from your account?</p>
                    <p class="mb-4 text-gray-500 dark:text-gray-300">This action cannot be undone.</p>
                    <div class="flex items-center justify-center space-x-4">
                        <button data-modal-toggle="deleteOrderModal" type="button"
                            class="rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-900 focus:z-10 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-600">No,
                            cancel</button>
                        <button type="submit"
                            class="rounded-lg bg-red-700 px-3 py-2 text-center text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Yes,
                            delete</button>
                    </div>
                </div>
            </div>
        </div>
        </main>
        </div>
    </section>

    <script>
        // Toggle sidebar for mobile
        const mobileSidebarToggle = document.getElementById('mobileSidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        mobileSidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            sidebarOverlay.classList.toggle('hidden');
        });

        // Close sidebar when clicking outside
        sidebarOverlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        });
    </script>
</body>

</html>
