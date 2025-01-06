@extends('components.kaprodi')

@section('content')
@if(Route::currentRouteName() == 'kelas.index' || Route::currentRouteName() == 'kelas.search')
    <!-- Start block -->
    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-4 mt-5">
            <!-- Start coding here -->
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-full md:w-1/2">
                        <form action="{{ route('kelas.search') }}" method="GET"  class="flex items-center">
                            <label for="simple-search" class="sr-only">Cari</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" name="search" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Cari berdasarkan Nama Kelas" required>
                            </div>
                            <button type="submit" class="ml-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                Cari
                            </button>
                        </form>
                    </div>
                    <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        <button type="button" id="tambahKelasBtn" data-modal-target="createKelasModal" data-modal-toggle="createKelasModal" class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                            Tambah Kelas
                        </button>
                    </div>
                </div>
                <div class="overflow-x-auto mt-5">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-4">No</th>
                                <th scope="col" class="px-4 py-3">Nama</th>
                                <th scope="col" class="px-4 py-3">Kouta Kelas</th>
                                <th scope="col" class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        @foreach($kelas as $kelas)
                        <tr class="border-b dark:border-gray-700">
                            <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $loop->iteration }}
                            </th>
                            <td class="px-4 py-3">{{ $kelas->name }}</td>
                            <td class="px-4 py-3">{{ $kelas->jumlah }}</td>
                            <td class="flex items-center">
                                <ul class="text-sm">
                                    <li>
                                        <button onclick="openUpdateModal('{{ $kelas->id }}','{{ $kelas->name }}', '{{ $kelas->jumlah }}')" class="flex w-full items-center py-2 px-4 hover:bg-yellow-100 dark:hover:bg-yellow-600 dark:hover:text-white text-yellow-500 dark:text-yellow-200">
                                            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" />
                                            </svg>
                                            Edit
                                        </button>
                                    </li>
                                    <li>
                                        <button onclick="openDeleteModal('{{ $kelas->id }}')" class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 text-red-600 dark:hover:text-red-400">
                                            <svg class="w-4 h-4 mr-2" viewbox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path fill-rule="evenodd" clip-rule="evenodd" fill="currentColor" d="M6.09922 0.300781C5.93212 0.30087 5.76835 0.347476 5.62625 0.435378C5.48414 0.523281 5.36931 0.649009 5.29462 0.798481L4.64302 2.10078H1.59922C1.36052 2.10078 1.13161 2.1956 0.962823 2.36439C0.79404 2.53317 0.699219 2.76209 0.699219 3.00078C0.699219 3.23948 0.79404 3.46839 0.962823 3.63718C1.13161 3.80596 1.36052 3.90078 1.59922 3.90078V12.9008C1.59922 13.3782 1.78886 13.836 2.12643 14.1736C2.46399 14.5111 2.92183 14.7008 3.39922 14.7008H10.5992C11.0766 14.7008 11.5344 14.5111 11.872 14.1736C12.2096 13.836 12.3992 13.3782 12.3992 12.9008V3.90078C12.6379 3.90078 12.8668 3.80596 13.0356 3.63718C13.2044 3.46839 13.2992 3.23948 13.2992 3.00078C13.2992 2.76209 13.2044 2.53317 13.0356 2.36439C12.8668 2.1956 12.6379 2.10078 12.3992 2.10078H9.35542L8.70382 0.798481C8.62913 0.649009 8.5143 0.523281 8.37219 0.435378C8.23009 0.347476 8.06631 0.30087 7.89922 0.300781H6.09922ZM5.21922 3.90078H8.77922V2.10078H5.21922V3.90078ZM10.5992 4.70078H3.39922V12.9008C3.39922 12.9785 3.43119 13.0519 3.48754 13.1082C3.54388 13.1646 3.61727 13.1966 3.69492 13.1966H10.3035C10.3812 13.1966 10.4546 13.1646 10.5109 13.1082C10.5673 13.0519 10.5992 12.9785 10.5992 12.9008V4.70078ZM5.97922 6.50078C6.21792 6.50078 6.44683 6.5956 6.61561 6.76439C6.7844 6.93317 6.87922 7.16209 6.87922 7.40078V10.9008C6.87922 11.1395 6.7844 11.3684 6.61561 11.5372C6.44683 11.706 6.21792 11.8008 5.97922 11.8008C5.74052 11.8008 5.51161 11.706 5.34282 11.5372C5.17404 11.3684 5.07922 11.1395 5.07922 10.9008V7.40078C5.07922 7.16209 5.17404 6.93317 5.34282 6.76439C5.51161 6.5956 5.74052 6.50078 5.97922 6.50078ZM8.01922 7.40078C8.01922 7.16209 8.11404 6.93317 8.28282 6.76439C8.45161 6.5956 8.68052 6.50078 8.91922 6.50078C9.15792 6.50078 9.38683 6.5956 9.55561 6.76439C9.7244 6.93317 9.81922 7.16209 9.81922 7.40078V10.9008C9.81922 11.1395 9.7244 11.3684 9.55561 11.5372C9.38683 11.706 9.15792 11.8008 8.91922 11.8008C8.68052 11.8008 8.45161 11.706 8.28282 11.5372C8.11404 11.3684 8.01922 11.1395 8.01922 10.9008V7.40078Z"/>
                                            </svg>
                                            Hapus
                                        </button>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Create modal -->
    <div id="createKelasModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-gray-900 bg-opacity-50">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <!-- Modal header -->
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Tambah Kelas</h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="closeCreateModal()">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Tutup</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('kelas.store') }}" method="POST">
                    @csrf
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="cth: TI 2A" required>
                        </div>
                        <div class="col-span-2">
                            <label for="jumlah" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kouta Kelas</label>
                            <input type="text" name="jumlah" id="jumlah" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="cth: 10" required>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm py-2 px-3 mt-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Tambah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Update modal -->
    <div id="updateKelasModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-gray-900 bg-opacity-50">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <!-- Modal header -->
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Update Kelas</h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="closeUpdateModal()">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Tutup</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form id="updateKelasForm" action="" method="POST">
                    @csrf
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div class="col-span-2">
                            <label for="update_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                            <input type="text" name="name" id="update_name" value="{{ $kelas->name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                        </div>
                        <div class="col-span-2">
                            <label for="update_jumlah" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kouta Kelas</label>
                            <input type="number" name="jumlah" id="update_jumlah" value="{{ $kelas->jumlah }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                        </div>
                    </div>
                    <div class="flex justify-end items-center space-x-2">
                        <button type="submit" class="text-white inline-flex items-center bg-yellow-400 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm py-2 px-3 mt-2 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                            <svg class="mr-1 -ml-1 w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" />
                            </svg>
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete modal -->
    <div id="deleteKelasModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-gray-900 bg-opacity-50">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <button type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="closeDeleteModal()">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
                <span class="sr-only">Tutup</span>
            </button>
            <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mt-6 mb-3.5 mx-auto" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            <p class="mt-4 mb-4 font-bold text-gray-500 dark:text-gray-300">Apakah anda yakin, menghapus data ini?</p>
            <div class="flex justify-center items-center space-x-2 mt-4">
                <form id="deleteKelasForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="text-gray-500 bg-gray-100 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2.5 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-600 ml-2" onclick="closeDeleteModal()">Batal</button>
                    <button type="submit" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Hapus</button>
                </form>
            </div>
        </div>
    </div>

@endif
    
<script>
    document.addEventListener('DOMContentLoaded', function() {
    var tambahBtn = document.getElementById('tambahKelasBtn');
    var createModal = document.getElementById('createKelasModal');
    var updateModal = document.getElementById('updateKelasModal');
    var deleteModal = document.getElementById('deleteKelasModal');

    tambahBtn.onclick = function() {
        createModal.classList.remove('hidden');
        createModal.classList.add('flex');
    }
    window.closeCreateModal = function() {
        createModal.classList.add('hidden');
        createModal.classList.remove('flex');
    }
    window.closeUpdateModal = function() {
        updateModal.classList.add('hidden');
        updateModal.classList.remove('flex');
    }
    window.closeDeleteModal = function() {
        deleteModal.classList.add('hidden');
        deleteModal.classList.remove('flex');
    }
    window.openUpdateModal = function(id, name, jumlah) {;
        document.getElementById('update_name').value = name;
        document.getElementById('update_jumlah').value = jumlah;
        document.getElementById('updateKelasForm').action = '/kelas/' + id;
        updateModal.classList.remove('hidden');
        updateModal.classList.add('flex');
    }
    window.openDeleteModal = function(id) {
        var form = document.getElementById('deleteKelasForm');
        form.action = '/kelas/' + id; 
        deleteModal.classList.remove('hidden');
        deleteModal.classList.add('flex');
    }
    
    window.onclick = function(event) {
        if (event.target == createModal) {
            closeCreateModal();
        }
        if (event.target == updateModal) {
            closeUpdateModal();
        }
        if (event.target == deleteModal) {
        closeDeleteModal();
        }
    }
    
    });
</script>

@endsection