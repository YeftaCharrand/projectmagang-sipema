@extends('components.dosen')

@section('content')
    <div class="flex-grow p-8 mt-8 mr-3">
        <!-- Box Container -->
        <div class="container mx-auto my-4">
            <div
                class="w-full bg-white dark:bg-gray-800 p-4 shadow-lg rounded-lg border border-gray-300 dark:border-gray-700">
                <!-- Title -->
                <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-300 mb-4">Pilih Kelas</h2>
                <!-- Dropdown Form -->
                <form action="{{ route('dosen.filterByClass') }}" method="GET">
                    <div class="relative">
                        <select name="kelas_id" id="kelas" onchange="this.form.submit()"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 appearance-none">
                            <option disabled {{ !request()->has('kelas_id') ? 'selected' : '' }}>Silahkan Pilih Kelas
                            </option>
                            @foreach ($kelas as $item)
                                <option value="{{ $item->id }}"
                                    {{ request()->get('kelas_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                                <option value="no_class" {{ request()->get('kelas_id') === 'no_class' ? 'selected' : '' }}>
                                    Belum memiliki kelas
                                </option>
                        </select>
                    </div>
                </form>
            </div>
        </div>

        @if (isset($mahasiswas))
            <!-- Tabel Mahasiswa -->
            <div class="bg-white dark:bg-gray-800 p-4 shadow-md rounded-lg mb-6">
                <div
                    class="flex-1 flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="flex-1 flex items-center space-x-2">
                        <h5 class="text-gray-500">Tabel Data Mahasiswa</h5>
                    </div>
                </div>
                <div
                    class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between mx-4 py-4 border-t dark:border-gray-700">
                </div>
                <div id="tampil" class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="p-4 text-center">No</th>
                                <th scope="col" class="p-4 text-center">NIM</th>
                                <th scope="col" class="p-4 text-center">Nama</th>
                                <th scope="col" class="p-4 text-center">Tempat Lahir</th>
                                <th scope="col" class="p-4 text-center">Tanggal Lahir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach ($mahasiswas as $m)
                                <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="px-4 py-3 text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $no++ }}
                                    </td>
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection
