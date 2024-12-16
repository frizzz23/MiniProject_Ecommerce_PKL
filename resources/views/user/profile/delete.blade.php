@extends('layouts.user')

@section('main')
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="flex items-center">
                <a href="{{ route('landing-page') }}"
                    class="flex justify-center  items-end gap-1  bg-white shadow-sm text-slate-800 w-auto py-1.5 px-2 rounded-md">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                        </g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M6.49996 7C7.96131 5.53865 9.5935 4.41899 10.6975 3.74088C11.5021 3.24665 12.4978 3.24665 13.3024 3.74088C14.4064 4.41899 16.0386 5.53865 17.5 7C20.6683 10.1684 20.5 12 20.5 15C20.5 16.4098 20.3895 17.5988 20.2725 18.4632C20.1493 19.3726 19.3561 20 18.4384 20H17C15.8954 20 15 19.1046 15 18V16C15 15.2043 14.6839 14.4413 14.1213 13.8787C13.5587 13.3161 12.7956 13 12 13C11.2043 13 10.4413 13.3161 9.87864 13.8787C9.31603 14.4413 8.99996 15.2043 8.99996 16V18C8.99996 19.1046 8.10453 20 6.99996 20H5.56152C4.64378 20 3.85061 19.3726 3.72745 18.4631C3.61039 17.5988 3.49997 16.4098 3.49997 15C3.49997 12 3.33157 10.1684 6.49996 7Z"
                                stroke="#1C274C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </g>
                    </svg>
                    <span class="font-semibold text-xs"> Beranda</span>
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class=" h-4 w-4 text-gray-400 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                            d="m9 5 7 7-7 7" />
                    </svg>
                    <a href=""
                        class="flex justify-center ml-2 items-end gap-1  bg-white shadow-sm text-slate-800  w-auto py-2 px-2 rounded-md">
                        <span class="font-semibold text-xs"> Akun</span>
                    </a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class=" h-4 w-4 text-gray-400 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                            d="m9 5 7 7-7 7" />
                    </svg>
                    <a href="{{ route('user.profile.delete') }}"
                        class="flex justify-center ml-2 items-end gap-1  bg-white shadow-sm text-slate-800 w-auto py-2 px-2 rounded-md">
                        <span class="font-semibold text-xs">Hapus</span>
                    </a>
                </div>
            </li>
        </ol>
    </nav>
    <div class="bg-white rounded-lg shadow-md p-6 mb-8 flex flex-col md:flex-row items-center gap-6 mt-4">
        <div class="flex-shrink-0">
            <img src="https://via.placeholder.com/192x192.png?text=Delete+Account" alt="Delete Account" class="w-48 h-48">

        </div>
        <div class="flex-grow">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Hapus Akun Saya</h2>
            <p class="text-gray-600 mb-4">
                Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus akun
                Anda, harap unduh data atau informasi apa pun yang ingin Anda simpan.
            </p>
            <button class="px-6 py-3 bg-red-500 text-white font-semibold rounded-lg shadow hover:bg-red-600 transition-all"
                data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 inline-block mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 13h6m2 9H7a2 2 0 01-2-2V7a2 2 0 012-2h3.5a1.5 1.5 0 003 0H17a2 2 0 012 2v13a2 2 0 01-2 2z" />
                </svg>
                Hapus Akun
            </button>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="{{ route('user.profile.destroy') }}" class="modal-content">
                @csrf
                @method('delete')

                <div class="modal-header">
                    <h5 class="modal-title" id="confirmUserDeletionModalLabel">
                        Apakah Anda yakin ingin menghapus akun Anda?
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p class="text-gray-600 mb-4">
                        Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Harap masukkan
                        kata sandi Anda untuk mengonfirmasi penghapusan akun.
                    </p>

                    <div class="mb-3">
                        <label for="password" class="form-label visually-hidden">Kata Sandi</label>
                        <input type="password" id="password" name="password"
                            class="form-control @error('password', 'userDeletion') is-invalid @enderror"
                            placeholder="Masukkan Kata Sandi" required>
                        @error('password', 'userDeletion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus Akun</button>
                </div>
            </form>
        </div>
    </div>
    
@endsection
