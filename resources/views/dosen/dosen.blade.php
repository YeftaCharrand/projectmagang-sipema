@extends('components.dosen')

@section('content')

<!-- resources/views/mahasiswa.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="bg-gray-100">
    {{-- <x-sidebar></x-sidebar>> --}}

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-1/5 bg-gray-100 dark:bg-gray-800 "></aside>
        <!-- Konten utama -->
        <main class="flex-grow p-8 mt-8 mr-3">
            <!-- Header dan Informasi Pengguna -->
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-6 rounded-lg shadow-lg mb-6 text-white">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                        <i class="fas fa-user-circle text-gray-500 dark:text-white text-3xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold">Selamat Datang, {{ Auth::user()->dosen->name }}</h1>
                    </div>
                </div>
            </div>
            <div class="container mx-auto p-4">
                <!-- Kontainer Utama -->
                <div
                    class="bg-white dark:bg-gray-800 p-6 shadow-lg rounded-lg border border-gray-300 dark:border-gray-700 space-y-6">
                    <div class="container mx-auto space-y-4 p-4">
                        <!-- Informasi Dosen Wali -->
                        <div
                            class="bg-white dark:bg-gray-800 p-6 shadow-lg rounded-lg mb-6 border border-gray-300 dark:border-gray-700">
                            <div class="flex items-center space-x-4 mb-4">
                                <div
                                    class="w-16 h-16 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                    <i class="fas fa-user-alt text-gray-500 dark:text-gray-400 text-3xl"></i>
                                </div>
                                <div>
                                    <h5 class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                                        {{ Auth::user()->dosen->name }}</h5>
                                    @if ($kelasName)
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Wali Kelas
                                            {{ $kelasName }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 border-t pt-4">
                                <div class="space-y-2">
                                    <p class="text-gray-700 dark:text-gray-400"><strong>NIP :
                                        </strong>{{ $nip }}</p>
                                </div>
                            </div>
                        </div>

                        @if ($isDosenWali)
                            <!-- Tabel Mahasiswa -->
                            <div class="bg-white dark:bg-gray-800 p-4 shadow-md rounded-lg mb-6">
                                <div
                                    class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                                    <div class="flex-1 flex items-center space-x-2">
                                        <h5>
                                            <span class="text-gray-500">Tabel Data Mahasiswa</span>
                                        </h5>
                                        <div id="results-tooltip" role="tooltip"
                                            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                            Showing 1-100 of 436 results
                                            <div class="tooltip-arrow" data-popper-arrow=""></div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between mx-4 py-4 border-t dark:border-gray-700">
                                    <div class="w-full md:w-1/2">
                                        <!-- Add Search Form -->
                                        <form method="GET" action="{{ route('dosen.search') }}" class="mb-4">
                                            <div class="flex items-center">
                                                <input type="text" name="search" value="{{ $search ?? '' }}"
                                                    placeholder="Search Mahasiswa..."
                                                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-800 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 w-full">
                                                <button type="submit"
                                                    class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                                                    Search
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                    <!-- Modal toggle -->
                                    <div class="flex justify-center m-5">
                                        <button id="defaultModalButton" data-modal-target="defaultModal"
                                            data-modal-toggle="defaultModal"
                                            class="block text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                                            type="button">
                                            + Tambah Data Mahasiswa
                                        </button>

                                        <!-- Main modal Tambah -->
                                        @include('partials.tambah-modal')
                                    </div>
                                </div>
                                <div id="tampil" class="overflow-x-auto">
                                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                        <thead
                                            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            <tr>
                                                <th scope="col" class="p-4 text-center">NIM</th>
                                                <th scope="col" class="p-4 text-center">Nama</th>
                                                <th scope="col" class="p-4 text-center">Tempat Lahir</th>
                                                <th scope="col" class="p-4 text-center">Tanggal Lahir</th>
                                                <th scope="col" class="p-4 text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($mahasiswas as $m)
                                                <tr
                                                    class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                    <td
                                                        class=" px-4 py-3 text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                        {{ $m->nim }}</td>
                                                    <td
                                                        class="px-4 py-3 text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                        {{ $m->name }}</td>
                                                    <td
                                                        class="px-4 py-3 text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                        {{ $m->tempat_lahir }}</td>
                                                    <td
                                                        class="px-4 py-3 text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                        {{ $m->tanggal_lahir }}</td>
                                                    <td
                                                        class="px-4 py-3 text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                        <div class="flex justify-center items-center space-x-4">
                                                            <!-- Button edit -->
                                                            <form action="{{ route('dosen.update', $m->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                    value="{{ $m->id }}">
                                                                <button id="updateProductButton"
                                                                    data-modal-target="updateProductModal{{ $m->id }}"
                                                                    data-modal-toggle="updateProductModal{{ $m->id }}"
                                                                    class="flex items-center text-yellow-400 hover:text-white border border-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-100 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-yellow-200 dark:text-yellow-200 dark:hover:text-white dark:hover:bg-yellow-200 dark:focus:ring-yellow-500"
                                                                    type="button">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        class="h-4 w-4 mr-2 -ml-0.5" viewBox="0 0 20 20"
                                                                        fill="currentColor" aria-hidden="true">
                                                                        <path
                                                                            d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                                        <path fill-rule="evenodd"
                                                                            d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                                            clip-rule="evenodd" />
                                                                    </svg>
                                                                    Edit
                                                                </button>
                                                            </form>
                                                            <!-- Update Product Modal -->
                                                            @include('partials.edit-modal')

                                                            <!-- Button hapus -->
                                                            <button type="button"
                                                                data-modal-target="delete-modal{{ $m->id }}"
                                                                data-modal-toggle="delete-modal{{ $m->id }}"
                                                                class="flex items-center text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    class="h-4 w-4 mr-2 -ml-0.5" viewBox="0 0 20 20"
                                                                    fill="currentColor" aria-hidden="true">
                                                                    <path fill-rule="evenodd"
                                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                                Delete
                                                            </button>
                                                            <!-- Delete Modal -->
                                                            @include('partials.delete-modal')
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@latest/dist/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
</body>

</html>

@endsection