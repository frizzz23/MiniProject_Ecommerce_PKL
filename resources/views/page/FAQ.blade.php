@extends('layouts.guest')
@section('content')
<div class="text-black py-12 px-6">
    <div class="max-w-3xl mx-auto">
    <a href="{{ route('landing-page') }}" class="mb-6 text-blue-700 text-sm font-medium block w-full">
            Kembali
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="text-blue-700 inline-block">
                <path d="M9 10h6c1.654 0 3 1.346 3 3s-1.346 3-3 3h-3v2h3c2.757 0 5-2.243 5-5s-2.243-5-5-5H9V5L4 9l5 4v-3z"></path>
            </svg>
        </a>
        <div class="bg-gradient-to-b w-full max-w-6xl rounded-lg overflow-hidden shadow-lg">
            <!-- Background and Header Section -->
            <div class="relative">
                <img src="{{ asset('img/contact.png') }}" alt="Background Image" class="w-full h-96 object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                <h1 class="text-3xl font-bold mb-8 text-white">Frequently asked questions (FAQ)</h1>
                </div>
            </div>
        <div class="space-y-4 mt-6">
            <!-- Dropdown Item 1 -->
            <div class="border border-gray-700 rounded-lg">
                <button type="button" class="w-full flex justify-between items-center px-6 py-4 text-left  font-medium hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-gray-700" data-dropdown-target="#faq1" aria-expanded="false">
                    Can I use Flowbite in open-source projects?
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-transform duration-300 transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="faq1" class="hidden px-6 py-4">
                    <p>Flowbite is an open-source library of interactive components built on top of Tailwind CSS including buttons, dropdowns, modals, navbars, and more.</p>
                    <p class="mt-2">Check out this guide to learn how to <a href="#" class="text-blue-500 hover:underline">get started</a> and start developing websites even faster with components on top of Tailwind CSS.</p>
                </div>
            </div>

            <!-- Dropdown Item 2 -->
            <div class="border border-gray-700 rounded-lg">
                <button type="button" class="w-full flex justify-between items-center px-6 py-4 text-left  font-medium hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-gray-700" data-dropdown-target="#faq2" aria-expanded="false">
                    Is there a Figma file available?
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-transform duration-300 transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="faq2" class="hidden px-6 py-4 ">
                    <p>Yes, you can access the Figma files from the official Flowbite resources page.</p>
                </div>
            </div>

            <!-- Dropdown Item 3 -->
            <div class="border border-gray-700 rounded-lg">
                <button type="button" class="w-full flex justify-between items-center px-6 py-4 text-left  font-medium hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-gray-700" data-dropdown-target="#faq3" aria-expanded="false">
                    What are the differences between Flowbite and Tailwind UI?
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-transform duration-300 transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="faq3" class="hidden px-6 py-4 ">
                    <p>Flowbite is a free and open-source library while Tailwind UI is a paid product offering more advanced components and designs.</p>
                </div>
            </div>

            <!-- Dropdown Item 4 -->
            <div class="border border-gray-700 rounded-lg">
                <button type="button" class="w-full flex justify-between items-center px-6 py-4 text-left  font-medium hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-gray-700" data-dropdown-target="#faq4" aria-expanded="false">
                    What about browser support?
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-transform duration-300 transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="faq4" class="hidden px-6 py-4 ">
                    <p>Flowbite supports all modern browsers such as Chrome, Firefox, Safari, and Edge.</p>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('[data-dropdown-target]').forEach(button => {
        button.addEventListener('click', () => {
            const targetId = button.getAttribute('data-dropdown-target');
            const targetElement = document.querySelector(targetId);

            if (targetElement) {
                const isOpen = targetElement.classList.contains('hidden');
                document.querySelectorAll('[data-dropdown-target]').forEach(b => {
                    const otherTargetId = b.getAttribute('data-dropdown-target');
                    const otherElement = document.querySelector(otherTargetId);
                    otherElement.classList.add('hidden');
                    b.querySelector('svg').classList.remove('rotate-180');
                });

                if (isOpen) {
                    targetElement.classList.remove('hidden');
                    button.querySelector('svg').classList.add('rotate-180');
                } else {
                    targetElement.classList.add('hidden');
                }
            }
        });
    });
</script>
@endsection
