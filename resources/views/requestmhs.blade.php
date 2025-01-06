@extends('components.dosen')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Edit Mahasiswa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="bg-gray-100">
    {{-- <x-sidebar></x-sidebar>> --}}
        <div >
            <!-- Konten utama -->
            <main class="flex-grow p-4  mr-3">
                <!-- Tabel -->
                <div class="bg-white dark:bg-gray-800 p-4 shadow-md rounded-lg mt-4">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                        <div class="flex-1 flex items-center space-x-2">
                            <h5>
                                <span class="text-gray-500">Request Edit Data Mahasiswa</span>
                            </h5>
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between mx-4 py-2 border-t dark:border-gray-700">
                    </div>

                    <div id="tampil" class="overflow-x-auto mt-3">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="p-5 text-center">NIM</th>
                                    <th scope="col" class="p-5 text-center">Nama</th>
                                    <th scope="col" class="p-5 text-center">keterangan</th>
                                    <th scope="col" class="p-5 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requestEdit as $mahasiswa)
                                    <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td class="text-center px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $mahasiswa->mahasiswa->nim }}</td>
                                        <td class="text-center px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $mahasiswa->mahasiswa->nama }}</td>
                                        <td class="text-center px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $mahasiswa->keterangan }}</td>
                                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <div class="flex justify-center items-center space-x-4">
                                                <!-- Form Setujui -->
                                                <form action="{{ route('update.request') }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $mahasiswa->mahasiswa->id }}">
                                                    <input type="hidden" name="edit" value="1">
                                                    <button type="submit" class="flex items-center text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-green-500 dark:text-white-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-900">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" viewBox="0 0 512 512" fill="currentColor" aria-hidden="true">
                                                            <path d="M173.898 439.404l-166.4-166.4c-8.836-8.836-8.836-23.142 0-31.978s23.142-8.836 31.978 0l132.468 132.47L472.564 39.686c8.836-8.836 23.142-8.836 31.978 0s8.836 23.142 0 31.978L205.876 439.404c-8.839 8.836-23.147 8.836-31.978 0z"/>
                                                        </svg>
                                                        Setujui
                                                    </button>
                                                </form>
    
                                                <!-- Form Tolak -->
                                                <form action="{{ route('update.request') }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $mahasiswa->mahasiswa->id }}">
                                                    <input type="hidden" name="edit" value="0">
                                                    <button type="submit" class="flex items-center text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                        </svg>
                                                        Tolak
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <x-logout>
                    {{-- LOG OUT MODAL --}}
                </x-logout>
                
            </main>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/flowbite@latest/dist/flowbite.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
</body>
</html>

@endsection