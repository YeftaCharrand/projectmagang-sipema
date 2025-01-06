@extends('components.kaprodi')

@section('content')

<section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased">
    <div class="p-2 mb-2">
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-4 md:space-x-4 p-4">
                <div class="w-full flex flex-col md:flex-row items-start md:items-center space-y-2 md:space-y-0 md:space-x-4">
                    <button id="tambah-dosenwaliModalButton" data-modal-target="tambah-dosenwali" data-modal-toggle="tambah-dosenwali" class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        <svg class="w-5 h-5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-6 7 2 2 4-4m-5-9v4h4V3h-4Z"/>
                        </svg>                            
                        Dosen Wali
                    </button>

                    <button id="tambah-mahasiswaModalButton" data-modal-target="tambah-mahasiswa" data-modal-toggle="tambah-mahasiswa" class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        <svg class="w-5 h-5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-6 7 2 2 4-4m-5-9v4h4V3h-4Z"/>
                        </svg>                                                    
                        Mahasiswa
                    </button>
                </div>
            </div>

            <div class="p-4">
                @include('components.plots.tambah-dosenwali')
                @include('components.plots.tambah-mahasiswa')
            </div>

            @foreach ($kelas as $k)
            <section class="bg-gray-50 dark:bg-gray-900 p-2 sm:p-2 antialiased">
                <div class="p-4 mb-4 bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                    <div class="flex justify-between mb-6 p-4 border-b dark:border-gray-600">
                        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">{{ $k->name }}</h5>
                    </div>
                    
                    <div class="flex ml-4 space-x-4">
                        <!-- Tabel Dosen Wali -->
                        <div class="flex-1">
                            <h4 class="text-base font-semibold text-gray-900 dark:text-white">Dosen Wali</h4>
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-800">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Kode Dosen</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">NIP</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Nama</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @if(isset($dosenByKelas[$k->id]) && $dosenByKelas[$k->id]->isNotEmpty())
                                        @foreach ($dosenByKelas[$k->id] as $dosen)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ $dosen->kode_dosen }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ $dosen->nip }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ $dosen->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <form action="{{ route('plotting.destroyKelasDosen', $dosen->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="flex w-full items-center text-red-600 hover:text-red-900">
                                                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="2" class="px-6 py-4 text-center text-sm font-medium text-gray-500 dark:text-gray-400">Belum ada dosen wali yang dipilih.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <!-- Tabel Mahasiswa -->
                        <div class="flex-1">
                            <h4 class="text-base font-semibold text-gray-900 dark:text-white">Mahasiswa</h4>
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-800">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">No</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">NIM</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Nama</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @if(isset($mahasiswaByKelas[$k->id]) && $mahasiswaByKelas[$k->id]->isNotEmpty())
                                        @foreach ($mahasiswaByKelas[$k->id] as $mahasiswa)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ $loop->iteration }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ $mahasiswa->nim }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ $mahasiswa->nama }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <form action="{{ route('plotting.destroyKelasMahasiswa', $mahasiswa->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="flex w-full items-center text-red-600 hover:text-red-900">
                                                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                        </svg>                                                                                                                    
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="2" class="px-6 py-4 text-center text-sm font-medium text-gray-500 dark:text-gray-400">Belum ada mahasiswa yang dipilih.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            @endforeach
        </div>
    </div>
</section>

@endsection