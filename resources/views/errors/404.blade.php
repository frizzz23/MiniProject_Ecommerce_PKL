<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen bg-gradient-to-br from-[#2E01B8] to-[#05F2F2] flex items-center justify-center text-white">
    <div class="text-center p-4 sm:p-8 lg:p-12 text-nowrap">
        <!-- Tambahkan SVG dari file -->
        <img src="{{ asset('img/404.svg') }}" alt="404 Icon" class="mx-auto mb-4 max-w-full h-auto" height="550px" width="550px">
        
        <h1 class="text-3xl sm:text-4xl font-bold mb-4">Halaman Tidak Ditemukan !</h1>
        <p class="text-lg mb-6">Maaf bung, Sepertinya Anda tersesat !</p>

        <!-- Tombol Kembali ke Index -->
        <a href="{{ url('/') }}" class="inline-block px-5 py-3 text-xl font-bold border-2 border-white hover:border-[#05F2F2] rounded-full  hover:text-[#05F2F2] transition-colors">
            Kembali ke Halaman Utama
        </a>
    </div>
</body>
</html>
