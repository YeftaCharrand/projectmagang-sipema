<!-- Edit Dosen Modal -->
<div id="editDosenModal{{ Auth::user()->dosen->id }}" tabindex="-1" aria-hidden="true"
    class="fixed inset-0 z-50 hidden overflow-y-auto overflow-x-hidden bg-black bg-opacity-50 justify-center items-center">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto mx-auto mt-10">
        <!-- Modal content -->
        <form method="POST" action="{{ route('dosenrole.updatedosen', Auth::user()->dosen->id) }}">
            @csrf
            @method('POST')
            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <!-- Modal header -->
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Edit Dosen
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="editDosenModal{{ Auth::user()->dosen->id }}">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="flex flex-col gap-4 mb-4">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Nama
                        </label>
                        <input type="text" id="name" name="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{ Auth::user()->dosen->name }}" required>
                    </div>
                    <div>
                        <label for="nip" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            NIP
                        </label>
                        <input type="text" id="nip" name="nip"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{ Auth::user()->dosen->nip }}" required>
                    </div>
                    <div>
                        <label for="kode_dosen" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Kode Dosen
                        </label>
                        <input type="text" id="kode_dosen" name="kode_dosen"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{ Auth::user()->dosen->kode_dosen }}" required>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="flex items-center justify-end space-x-4">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Simpan
                    </button>
                    <button type="button" data-modal-hide="editDosenModal{{ Auth::user()->dosen->id }}"
                        class="text-gray-500 bg-gray-300 hover:bg-gray-400 focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                        Batal
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        document.getElementById('editDosenButton').click();
    });
</script>
