@extends('layouts.guest')
@section('content')
    <div class="min-h-screen bg-neutral-100 flex flex-col items-center justify-center p-5">
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
                    <h1 class="text-white text-3xl font-bold">Contact Us</h1>
                </div>
            </div>
            <!-- Form Section -->
            <div class="p-6 bg-white">
                <p class="text-center text-slate-500 mb-6">
                    We use an agile approach to test assumptions and connect with the needs of your audience early and often.
                </p>
                <form action="#" method="POST" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                        <p class="text-gray-600 mb-2"><span class="font-bold text-gray-800">Name
                                </span><br> {{ Auth::user()->name ?? '-' }} </p>
                        </div>
                        <div>
                        <p class="text-gray-600 mb-2"><span class="font-bold text-gray-800">Home
                                    Address</span><br>2 Miles Drive, NJ 071, New York, United States of America</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                        <p class="text-gray-600 mb-2"><span class="font-bold text-gray-800">Email
                                    Address</span><br> {{ Auth::user()->email ?? '-' }} </p>
                        </div>
                        <div>
                        <p class="text-gray-600 mb-2"><span class="font-bold text-gray-800">Phone
                                    Number</span><br>{{ Auth::user()->no_telepon ?? '-' }}</p>
                        </div>
                    </div>
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700">Your Message</label>
                        <textarea id="message" name="message" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" placeholder="Leave a comment..."></textarea>
                    </div>
                    <div>
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Send Message
                        </button>
                    </div>
                    <p class="text-xs text-center text-gray-500">
                        By submitting this form you agree to our terms and conditions and our privacy policy which explains how we may collect, use, and disclose your personal information including to third parties.
                    </p>
                </form>
            </div>

            <!-- Footer Section -->
            <div class="py-8 mt-6 bg-white text-blue-400">
                <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                    <!-- Email Section -->
                    <div class="flex flex-col items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mb-3 text-black" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zm0 4.7-8 5.334L4 8.7V6.297l8 5.333 8-5.333V8.7z"></path>
                        </svg>
                        <p class="font-medium text-lg text-black">Email us:</p>
                        <p class="text-sm hover:underline ">hello@website.com</p>
                    </div>
                    <!-- Call Section -->
                    <div class="flex flex-col items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mb-3 text-black" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20 10.999h2C22 5.869 18.127 2 12.99 2v2C17.052 4 20 6.943 20 10.999z"></path>
                            <path d="M13 8c2.103 0 3 .897 3 3h2c0-3.225-1.775-5-5-5v2zm3.422 5.443a1.001 1.001 0 0 0-1.391.043l-2.393 2.461c-.576-.11-1.734-.471-2.926-1.66-1.192-1.193-1.553-2.354-1.66-2.926l2.459-2.394a1 1 0 0 0 .043-1.391L6.859 3.513a1 1 0 0 0-1.391-.087l-2.17 1.861a1 1 0 0 0-.29.649c-.015.25-.301 6.172 4.291 10.766C11.305 20.707 16.323 21 17.705 21c.202 0 .326-.006.359-.008a.992.992 0 0 0 .648-.291l1.86-2.171a1 1 0 0 0-.086-1.391l-4.064-3.696z"></path>
                        </svg>
                        <p class="font-medium text-lg text-black">Call us:</p>
                        <p class="text-sm hover:underline">+1 (604) 760-3860</p>
                    </div>
                    <!-- Support Section -->
                    <div class="flex flex-col items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mb-3 text-black" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm1 16h-2v-2h2v2zm.976-4.885c-.196.158-.385.309-.535.459-.408.407-.44.777-.441.793v.133h-2v-.167c0-.118.029-1.177 1.026-2.174.195-.195.437-.393.691-.599.734-.595 1.216-1.029 1.216-1.627a1.934 1.934 0 0 0-3.867.001h-2C8.066 7.765 9.831 6 12 6s3.934 1.765 3.934 3.934c0 1.597-1.179 2.55-1.958 3.181z"></path>
                        </svg>
                        <p class="font-medium text-lg text-black">Support:</p>
                        <button class="hover:underline">Support Center</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
