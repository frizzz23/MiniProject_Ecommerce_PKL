<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="container mx-auto my-8">
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Gambar Produk -->
        <div class="flex-shrink-0 w-full md:w-1/2">
            <div class="bg-gray-100 rounded-lg overflow-hidden h-full flex justify-center items-center">
                <img src="{{ asset('storage/' . $product->image_product) }}" alt="{{ $product->name_product }}"
                    class="max-w-full max-h-[400px] object-contain">
            </div>
        </div>

        <!-- Deskripsi Produk -->
        <div class="w-full md:w-1/2 flex flex-col">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $product->name_product }}</h1>
            <p class="text-3xl font-bold text-blue-600 mb-2">Rp {{ number_format($product->price_product, 0, ',', '.') }}</p>
            <div class="bg-gray-100 p-4 rounded-lg flex-grow">
                <div class="p-4">
                    <!-- Kategori -->
                    <div class="mb-4">
                        <p class="text-gray-600 font-medium">Kategori</p>
                        <p class="text-gray-800 font-semibold">{{ $product->category->name_category }}</p>
                    </div>
                    <!-- Stok -->
                    <div class="mb-4">
                        <p class="text-gray-600 font-medium">Stok</p>
                        <p class="text-gray-800 font-semibold">{{ $product->stock_product }} units</p>
                    </div>
                    <!-- Deskripsi -->
                    <div>
                        <p class="text-gray-600 font-medium">Deskripsi</p>
                        <div class="text-gray-800 font-normal leading-relaxed overflow-auto max-h-[300px]">
                            {!! nl2br(e($product->description_product)) !!}
                        </div>
                    </div>
                    <!-- Tombol Kembali -->
                    <div class="mt-4">
                        <a href="{{ route('admin.products.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
