@extends('layouts.admin')

@section('main')
<div class="container-fluid">
    <div class="container">
        <div class="card w-100">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Daftar Merek</h5>
                <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#tambahmodal">
                    Tambah Merek
                </button>
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0" style="width: 10%;">No</th>
                                <th class="border-bottom-0" style="width: 20%;">Gambar</th>
                                <th class="border-bottom-0" style="width: 40%;">Nama Merek</th>
                                <th class="border-bottom-0" style="width: 30%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                                <tr>
                                    <td class="border-bottom-0">{{ $loop->iteration }}</td>
                                    <td class="border-bottom-0">
                                        @if ($brand->image_brand)
                                            <img src="{{ asset('storage/' . $brand->image_brand) }}" alt="Gambar Brand" class="img-thumbnail" style="width: 100px; height: auto;">
                                        @else
                                            <span class="text-gray-500">Tidak ada gambar</span>
                                        @endif
                                    </td>
                                    <td class="border-bottom-0">{{ $brand->name_brand }}</td>
                                    <td class="border-bottom-0">
                                        <div class="d-flex align-items-center gap-2">
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editmodal{{ $brand->id }}">
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusmodal{{ $brand->id }}">
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Modal Edit -->
                                <div class="modal fade" id="editmodal{{ $brand->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Merek</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="edit_name_brand" class="form-label">Nama Merek</label>
                                                        <input type="text" name="name_brand" class="form-control" value="{{ $brand->name_brand }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="edit_image_brand" class="form-label">Gambar</label>
                                                        <input type="file" name="image_brand" class="form-control">
                                                        <small>Biarkan kosong jika tidak ingin mengubah gambar.</small>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Hapus -->
                                <div class="modal fade" id="hapusmodal{{ $brand->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus merek <strong>{{ $brand->name_brand }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
<div class="modal fade" id="tambahmodal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Tambah Merek</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form inside modal -->
                <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Input Nama Merek -->
                    <div class="mb-3">
                        <label for="name_brand" class="form-label">Nama Merek</label>
                        <input type="text" name="name_brand" class="form-control" id="name_brand"
                               value="{{ old('name_brand') }}">
                        @error('name_brand')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Gambar Merek -->
                    <div class="mb-3">
                        <label for="image_brand" class="form-label">Gambar Merek</label>
                        <input type="file" name="image_brand" class="form-control" id="image_brand"
                               accept="image/*">
                        @error('image_brand')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tombol Modal -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk Menampilkan Modal Jika Ada Error -->
@if ($errors->any())
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var tambahModal = new bootstrap.Modal(document.getElementById('tambahmodal'));
            tambahModal.show();
        });
    </script>
@endif

</div>
@endsection
