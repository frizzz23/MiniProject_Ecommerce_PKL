{{-- <div class="mx-5 my-4">
    <div class="max-w-full mx-auto  bg-white border mt-2 rounded-lg py-4 px-10 ">
        <!-- Desktop Version (hidden on mobile) -->
        <div class="hidden md:flex md:flex-row items-center justify-between relative">
            <!-- Progress Line for Desktop -->
            <div class="hidden md:block absolute left-0 right-0 top-1/2 h-0.5 bg-gray-200 -translate-y-1/2">
                <div class="h-[3px] bg-blue-500 w-full"></div>
            </div>

            <!-- Step 1 -->
            <div class="flex flex-col items-center relative mb-8 md:mb-0">
                <div class="md:hidden absolute h-full w-0.5 bg-green-500 top-10 left-1/2 -translate-x-1/2"></div>
                <!-- Modifikasi pada elemen ikon -->
                <div
                    class="w-12 h-12 rounded-full flex items-center justify-center z-10 border-[3px] border-blue-500 text-blue-500 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <div class="text-center mt-2">
                    <h4 class="text-sm font-medium">Pesanan Dibuat</h4>
                    <p class="text-xs text-gray-500 mt-1">07-10-2024 12:08</p>
                </div>
            </div>


            <!-- Step 2 -->
            <div class="flex flex-col items-center relative mb-8 md:mb-0">
                <div class="md:hidden absolute h-full w-0.5 bg-green-500 top-10 left-1/2 -translate-x-1/2"></div>
                <div
                    class="w-12 h-12 rounded-full flex items-center justify-center z-10 border-[3px] border-blue-500 text-blue-500  mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                </div>
                <div class="text-center mt-2">
                    <h4 class="text-sm font-medium">Pembayaran Dikonfirmasi</h4>
                    <p class="text-xs text-gray-500 mt-1">07-10-2024 12:08</p>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="flex flex-col items-center relative mb-8 md:mb-0">
                <div class="md:hidden absolute h-full w-0.5 bg-green-500 top-10 left-1/2 -translate-x-1/2"></div>
                <div
                    class="w-12 h-12 rounded-full flex items-center justify-center z-10 border-[3px] border-blue-500 text-blue-500  mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                    </svg>
                </div>
                <div class="text-center mt-2">
                    <h4 class="text-sm font-medium">Pesanan Dikirimkan</h4>
                    <p class="text-xs text-gray-500 mt-1">07-10-2024 18:16</p>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="flex flex-col items-center relative mb-8 md:mb-0">
                <div class="md:hidden absolute h-full w-0.5 bg-green-500 top-10 left-1/2 -translate-x-1/2"></div>
                <div
                    class="w-12 h-12 rounded-full flex items-center justify-center z-10 border-[3px] border-blue-500 text-blue-500  mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div class="text-center mt-2">
                    <h4 class="text-sm font-medium">Pesanan Selesai</h4>
                    <p class="text-xs text-gray-500 mt-1">08-10-2024 19:32</p>
                </div>
            </div>
        </div>

        <!-- Mobile Version (hidden on desktop) -->
        <div class="md:hidden relative">
            <!-- Vertical line -->
            <div class="absolute left-6 top-6 bottom-0 w-[3px] bg-blue-500"></div>

            <!-- Timeline items -->
            <div class="space-y-8">
                <!-- Item 1 -->
                <div class="relative flex items-center gap-4">
                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-full border-[3px] bg-gray-100 border-blue-500 text-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <h3 class="text-white font-medium">Estimated delivery tomorrow</h3>
                        <p class="text-slate-400 text-sm">Tomorrow 24 November 2023</p>
                    </div>
                </div>
                <div class="relative flex items-center gap-4">
                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-full border-[3px] bg-gray-100 border-blue-500 text-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <h3 class="text-white font-medium">Estimated delivery tomorrow</h3>
                        <p class="text-slate-400 text-sm">Tomorrow 24 November 2023</p>
                    </div>
                </div>
                <div class="relative flex items-center gap-4">
                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-full border-[3px] bg-gray-100 border-blue-500 text-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <h3 class="text-white font-medium">Estimated delivery tomorrow</h3>
                        <p class="text-slate-400 text-sm">Tomorrow 24 November 2023</p>
                    </div>
                </div>
                <div class="relative flex items-center gap-4">
                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-full border-[3px] bg-gray-100 border-blue-500 text-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <h3 class="text-white font-medium">Estimated delivery tomorrow</h3>
                        <p class="text-slate-400 text-sm">Tomorrow 24 November 2023</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}



