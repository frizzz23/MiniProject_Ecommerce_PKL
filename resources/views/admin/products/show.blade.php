<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="container mx-auto px-4 py-8">
    <div class="grid md:grid-cols-2 gap-8">
        <!-- Detail Produk -->
        <div class="space-y-6">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h1 class="text-3xl font-bold text-gray-900 mb-4 border-b pb-3">{{ $product->name_product }}</h1>
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <!-- Harga -->
                    <div>
                        <p class="text-sm text-gray-600 uppercase tracking-wide">Harga</p>
                        <p class="text-2xl font-bold text-blue-600">
                            Rp {{ number_format($product->price_product, 0, ',', '.') }}
                        </p>
                    </div>
                    
                    <!-- Kategori -->
                    <div>
                        <p class="text-sm text-gray-600 uppercase tracking-wide">Kategori</p>
                        <p class="text-lg font-semibold text-gray-800">
                            {{ $product->category->name_category }}
                        </p>
                    </div>
                </div>

                <!-- Stok dan Status -->
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <p class="text-sm text-gray-600 uppercase tracking-wide">Stok</p>
                        <p class="text-lg font-semibold 
                            {{ $product->stock_product > 10 ? 'text-green-600' : 
                               ($product->stock_product > 0 ? 'text-yellow-600' : 'text-red-600') }}">
                            {{ $product->stock_product }} unit
                        </p>
                    </div>
                    
                    <div>
                        <p class="text-sm text-gray-600 uppercase tracking-wide">Status</p>
                        <span class="
                            px-3 py-1 rounded-full text-xs font-bold 
                            {{ $product->stock_product > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $product->stock_product > 0 ? 'Tersedia' : 'Habis' }}
                        </span>
                    </div>
                </div>

                <!-- Deskripsi Produk -->
                <div class="border-t pt-4">
                    <p class="text-sm text-gray-600 uppercase tracking-wide mb-2">Deskripsi</p>
                    <div class="text-gray-800 leading-relaxed max-h-[250px] overflow-y-auto rounded-lg bg-gray-50 p-4">
                        {!! nl2br(e($product->description_product)) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>