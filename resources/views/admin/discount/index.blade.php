<!-- resources/views/categories/index.blade.php -->

@extends('layouts.admin')

@section('main')
    <div class="container-fluid">
        <div class="container">
            <!-- Header Section -->

            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Daftar Kode Promo') }}
            </h2>


            <div class="container">
                <!-- Content Section -->
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#tambahmodal">
                                Tambah Diskon
                            </button>
                            <div class="p-6 text-gray-900 dark:text-gray-100">


                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
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

                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kode Discount</th>
                                            <th>Diskon</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($codes as $code)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $code->code }}</td>
                                                <td>Rp. {{ number_format($code->discount_amount, 0, ',', '.') }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-warning btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#editmodal"
                                                        onclick="openEditModal('{{ $code->id }}')">
                                                        Edit
                                                    </button>

                                                    <form action="{{ route('admin.discount.destroy', $code->id) }}"
                                                        method="POST" class="d-inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="editmodal" tabindex="-1"
                                                aria-labelledby="editModalLabel{{ $code->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel{{ $code->id }}">
                                                                Edit Diskon</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Form inside modal -->
                                                            <form action="{{ route('admin.discount.update', $code->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT') <!-- Untuk method PUT -->
                                                                <div class="mb-3">
                                                                    <label for="code" class="form-label">Kode
                                                                        Diskon</label>
                                                                    <input type="text" name="code"
                                                                        class="form-control"
                                                                        value="{{ old('code') ?? $code->code }}"
                                                                        id="code" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="discount_amount" class="form-label">Jumlah
                                                                        Diskon</label>
                                                                    <input type="number" name="discount_amount"
                                                                        value="{{ old('discount_amount') ?? $code->discount_amount }}"
                                                                        class="form-control" id="discount_amount" required>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Kembali</button>
                                                                    <button type="submit" class="btn btn-primary">Simpan
                                                                        Perubahan</button>
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
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="tambahmodal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Tambah Diskon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form inside modal -->
                    <form action="{{ route('admin.discount.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="code" class="form-label">Kode Diskon</label>
                            <input type="text" name="code" class="form-control" id="code" required>
                        </div>
                        <div class="mb-3">
                            <label for="discount_amount" class="form-label">Jumlah Diskon</label>
                            <input type="number" name="discount_amount" class="form-control" id="discount_amount" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
