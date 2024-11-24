@extends('layouts.app')

@section('main')
    <div class="container">
        <h1>Daftar Produk</h1>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahmodal">
            Tambah kategori
        </button>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Produk</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name_product }}</td>
                        <td>{{ Str::limit($product->description_product, 50) }}</td>
                        <td>Rp {{ number_format($product->price_product, 0, ',', '.') }}</td>
                        <td>{{ $product->category->name_category }}</td>
                        <td>{{ $product->stock_product }}</td>
                        <td>
                            @if ($product->images)
                                <img src="{{ asset('storage/' . $product->images->first()->image_product) }}"
                                    alt="Gambar Produk" class="img-thumbnail mt-2" style="max-width: 200px;">
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editmodal_{{ $product->id }}"
                                onclick="openEditModal('{{ $product->id }}')">
                                Edit
                            </button>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    <div class="modal fade" id="editmodal_{{ $product->id }}" tabindex="-1"
                        aria-labelledby="editModalLabel{{ $product->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content" style="padding: 20px;">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{ $product->id }}">Edit Produk</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="max-height: 80vh; overflow-y: auto; padding: 20px;">
                                    <!-- Form inside modal -->
                                    <form action="{{ route('products.update', $product->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')

                                        <!-- Baris Pertama: Nama Produk dan Kategori -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="name_product" class="form-label">Nama Produk</label>
                                                    <input type="text" name="name_product" class="form-control"
                                                        id="name_product"
                                                        value="{{ old('name_product') ?? $product->name_product }}"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="category_id" class="form-label">Kategori</label>
                                                    <select name="category_id" class="form-control" id="category_id"
                                                        required>
                                                        <option value="">Pilih Kategori</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"
                                                                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                                {{ $category->name_category }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Baris Kedua: Stok dan Harga -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="stock_product" class="form-label">Stok Produk</label>
                                                    <input type="number" name="stock_product" class="form-control"
                                                        id="stock_product"
                                                        value="{{ old('stock_product') ?? $product->stock_product }}"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="price_product" class="form-label">Harga Produk</label>
                                                    <input type="number" name="price_product" class="form-control"
                                                        id="price_product"
                                                        value="{{ old('price_product') ?? $product->price_product }}"
                                                        required>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Baris Ketiga: Deskripsi Produk -->
                                        <div class="mb-3">
                                            <label for="description_product" class="form-label">Deskripsi Produk</label>
                                            <textarea name="description_product" class="form-control" id="description_product" rows="5" required>{{ old('description_product') ?? $product->description_product }}</textarea>
                                        </div>

                                        <!-- Baris Keempat: Gambar Produk -->
                                        <div class="mb-3">
                                            <label for="image_product" class="form-label">Gambar Produk</label>

                                            @if ($product->images && count($product->images) > 0)
                                                @foreach ($product->images as $image)
                                                    <div class="mt-4">
                                                        <input type="file" accept="image/*"
                                                            name="image_edit_product[{{ $image->id }}]"
                                                            class="form-control"
                                                            onchange="reviewImage(this, 'target_image_edit_{{ $image->id }}')">
                                                        <input type="hidden" name="image_id[{{ $image->id }}]"
                                                            value="{{ $image->id }}" id="image_id_{{ $image->id }}">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <img src="{{ asset('storage/' . $image->image_product) }}"
                                                                alt="Gambar Produk" class="img-thumbnail mt-2"
                                                                style="max-width: 200px;"
                                                                id="target_image_edit_{{ $image->id }}">
                                                            @if (count($product->images) > 1)
                                                                <button type="button" class="btn btn-danger"
                                                                    onclick="removeImage(this.parentNode.parentNode)">Hapus</button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif

                                            <div id="image_edit_products">
                                                <div class="mb-4 flex">
                                                    <input type="file" name="image_product[]" accept="image/*"
                                                        class="form-control w-full"
                                                        onchange="reviewImage(this, 'target_image_update }}')">
                                                    <div class="position-relative">
                                                        <img id="target_image_update" class="w-full rounded-md"
                                                            style="max-width: 200px;" />
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm position-absolute bottom-0 end-0"
                                                            onclick="removeImage(this.parentNode.parentNode)">X</button>
                                                    </div>
                                                </div> {{-- jangan dihapus --}}
                                            </div>

                                            <div class="mb-3">
                                                <button type="button" class="btn btn-success w-full"
                                                    onclick="addImage('image_edit_products')">Tambah Foto</button>
                                            </div>
                                        </div>


                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan Produk</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="tambahmodal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form inside modal -->
                    <div class="modal-body">
                        <!-- Form inside modal -->
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name_product" class="form-label">Nama Produk</label>
                                <input type="text" name="name_product" class="form-control" id="name_product"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="description_product" class="form-label">Deskripsi Produk</label>
                                <textarea name="description_product" class="form-control" id="description_product" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="price_product" class="form-label">Harga Produk</label>
                                <input type="number" name="price_product" class="form-control" id="price_product"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="stock_product" class="form-label">Stok Produk</label>
                                <input type="number" name="stock_product" class="form-control" id="stock_product"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="category_id" class="form-label">Kategori</label>
                                <select name="category_id" class="form-control" id="category_id" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name_category }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="image_product" class="form-label">Gambar Produk</label>
                                <input type="file" name="image_product[]" onchange="reviewImage(this, 'target_image')"
                                    accept="image/*" class="form-control" id="image_product">
                                <img id="target_image" class="w-full rounded-md" />
                                <div id="image_products"></div>
                            </div>

                            <div class="mb-3">
                                <button type="button" class="btn btn-success w-full"
                                    onclick="addImage('image_products')">Tambah
                                    Foto</button>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan Produk</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            let id = 0

            function addImage(id) {
                const image_products = document.getElementById(id);
                const div = document.createElement('div');
                div.classList.add('mt-4');
                div.innerHTML = `
        <input type="file" name="image_product[]" onchange="reviewImage(this, 'target_image_${id}')" accept="image/*" class="form-control w-full">
       <div class="position-relative">
        <img id="target_image_${id}" class="rounded-md"  style="max-width: 200px;"/>
        <button type="button" class="btn btn-danger btn-sm position-absolute bottom-0 end-0" onclick="removeImage(this.parentNode.parentNode)">X</button>
        </div>
    `;
                image_products.appendChild(div);
                id++
            }



            function removeImage(element) {
                element.remove();
            }

            function reviewImage(element, target) {
                const [file] = element.files;
                const extension_available = ['png', 'jpg', 'jpeg'];
                const extension_file = file['type'].split('/')[1];
                if (extension_available.includes(extension_file)) {
                    document.getElementById(target).src = URL.createObjectURL(file);
                }
            }
        </script>
    @endsection
