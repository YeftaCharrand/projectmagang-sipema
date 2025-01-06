@extends('components.dosen')

@section('content')
    <div class="flex-grow container mx-auto p-2 dark:border-gray-700 ">
        <div class="bg-white dark:bg-gray-800 p-5 shadow-md rounded-lg mb-4">
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-6 rounded-lg shadow-lg mb-6 text-white">
                <div class="flex items-center space-x-4">
                    {{-- <div class="w-16 h-16 rounded-full bg-blue-500 dark:bg-gray-700 flex items-center justify-center"> --}}
                    {{-- <svg class="h-20 w-20 text-zinc-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg> --}}
                    <img src="../../../img/icon.jpg" class="w-12 h-12 rounded-full object-cover" alt="">

                    {{-- <i class="fas fa-user-circle text-gray-500 dark:text-white text-3xl"></i> --}}
                    {{-- </div> --}}
                    <div>
                        <h1 class="text-4xl font-bold">Selamat Datang, {{ Auth::user()->dosen->name }}</h1>
                    </div>
                </div>
            </div>

            <p class="text-base text-gray-500 dark:text-gray-400 mb-2">Email: {{ Auth::user()->email }}</p>
            @if (Auth::user()->role === 'dosen')
                <p class="text-base text-gray-600 dark:text-gray-400 mb-2">NIP: {{ $nip }}</p>
                @if ($kelasName)
                    <p class="text-base text-gray-600 dark:text-gray-400 mb-2">Wali Kelas: {{ $kelasName }}</p>
                @endif
                <p class="font-bold text-base text-gray-600 dark:text-gray-400">Pilih menu di samping untuk mengelola kelas
                    dan mahasiswa.</p>

                    <div class="ml-auto flex items-center mt-4">
                        <form action="{{ route('dosenrole.updatedosen', Auth::user()->dosen->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ Auth::user()->dosen->id }}">
                            <button id="editDosenButton"
                                data-modal-target="editDosenModal{{ Auth::user()->dosen->id }}"
                                data-modal-toggle="editDosenModal{{ Auth::user()->dosen->id }}"
                                class="flex items-center text-blue-500 hover:text-white border border-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-blue-400 dark:text-blue-400 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800"
                                type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5"
                                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path
                                        d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                    <path fill-rule="evenodd"
                                        d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                        clip-rule="evenodd" />
                                </svg>
                                Edit Data Dosen
                            </button>
                        </form>
                        <!-- Update Product Modal -->
                        @include('components.partials.editdosen-modal')
                    </div>
            @endif
        </div>
    </div>

    

    </div>


    <main class="flex-grow container pl-8 pr-5 dark:border-gray-700">
        @if ($isDosenWali)
            <!-- Tabel Mahasiswa -->
            <div class="bg-white dark:bg-gray-800 p-4 shadow-md rounded-lg">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between md:space-x-4 p-4">
                    <h3 class="text-grey-500 flex-1 flex items-center "> Tabel Data Mahasiswa </h3>
                </div>

                <div
                    class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-7 space-y-3 md:space-y-0 justify-between mx-4 py-4 border-t dark:border-gray-700">
                    <div class="flex-1 md:flex-none max-w-md">
                        <!-- Search -->
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

                    <!-- Button Tambah -->
                    <div class="flex justify-center m-5 ">
                        <button id="defaultModalButton" data-modal-target="defaultModal" data-modal-toggle="defaultModal"
                            class="flex items-center text-blue-500 hover:text-white border border-blue-500 hover:bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-100 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-blue-300 dark:text-blue-300 dark:hover:text-white dark:hover:bg-blue-300 dark:focus:ring-blue-500"
                            type="button">
                            + Tambah Data Mahasiswa
                        </button>
                        <!-- Main modal Tambah -->
                        @include('components.partials.tambah-modal')
                    </div>
                </div>

                <!-- Main Table -->
                <div id="tampil" class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                                <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td
                                        class=" px-4 py-3 text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $m->nim }}</td>
                                    <td
                                        class="px-4 py-3 text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $m->nama }}</td>
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
                                            <form action="{{ route('dosenrole.update', $m->id) }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $m->id }}">
                                                <button id="updateProductButton"
                                                    data-modal-target="updateProductModal{{ $m->id }}"
                                                    data-modal-toggle="updateProductModal{{ $m->id }}"
                                                    class="flex items-center text-yellow-400 hover:text-white border border-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-100 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-yellow-200 dark:text-yellow-200 dark:hover:text-white dark:hover:bg-yellow-200 dark:focus:ring-yellow-500"
                                                    type="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5"
                                                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
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
                                            @include('components.partials.edit-modal')

                                            <!-- Button hapus -->
                                            <form action="{{ route('dosenrole.destroykelas', $m->id) }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $m->id }}">
                                                <button type="button" data-modal-target="delete-modal{{ $m->id }}"
                                                    data-modal-toggle="delete-modal{{ $m->id }}"
                                                    class="flex items-center text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5"
                                                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Keluarkan
                                                </button>
                                            </form>
                                            <!-- Delete Modal -->
                                            @include('components.partials.delete-modal')
                                        </div>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </main>
@endsection
