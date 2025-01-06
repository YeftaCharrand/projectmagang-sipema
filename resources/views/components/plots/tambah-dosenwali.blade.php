<!-- Main Modal Tambah Dosen Wali -->
<div id="tambah-dosenwali" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-opacity-50">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal Header -->
            <div class="flex justify-between items-center p-4 border-b dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Pilih Dosen Wali</h3>
                <button type="button" data-modal-toggle="tambah-dosenwali" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Tutup</span>
                </button>
            </div>
            <!-- Modal Body -->
            <form action="{{ route('plotting.updateKelasDosen') }}" method="POST">

                @csrf
                <div class="p-4">
                    <!-- Pilihan Kelas -->
                    <label for="id_kelas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kelas</label>
                    <select name="id_kelas" id="id_kelas" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option selected disabled>Pilih Kelas</option>
                        @foreach ($kelasTersedia as $k)
                        <option value="{{ $k->id }}">{{ $k->name }}</option>
                        @endforeach
                    </select>

                    <!-- Pilihan Dosen -->
                    <label for="id_dosen" class="block mt-4 mb-2 text-sm font-medium text-gray-900 dark:text-white">Dosen Wali</label>
                    <select name="id_dosen" id="id_dosen" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option selected disabled>Pilih Dosen Wali</option>
                        @foreach ($dosen as $d)
                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                        @endforeach
                    </select>

                    <!-- Submit Button -->
                    <div class="flex justify-end mt-4">
                        <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm py-2 px-3 mt-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-5 h-5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-6 7 2 2 4-4m-5-9v4h4V3h-4Z"/>
                            </svg>
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('tambah-dosenwali');
        const openButton = document.getElementById('tambah-dosenwaliModalButton');
        const closeButton = modal.querySelector('[data-modal-toggle="tambah-dosenwali"]');

        if (openButton) {
            openButton.addEventListener('click', () => {
                modal.classList.remove('hidden');
            });
        }

        if (closeButton) {
            closeButton.addEventListener('click', () => {
                modal.classList.add('hidden');
            });
        }
    });
</script>