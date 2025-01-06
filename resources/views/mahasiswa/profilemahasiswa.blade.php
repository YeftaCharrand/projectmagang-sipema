@extends('components.mhs')

@section('content')
    <!-- Start block -->
    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-2"></div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-3">Nomor Induk Mahasiswa</th>
                        <th scope="col" class="px-6 py-3">Nama Mahasiswa</th>
                        <th scope="col" class="px-6 py-3">Kelas</th>
                        <th scope="col" class="px-6 py-3">Tempat Lahir</th>
                        <th scope="col" class="px-6 py-3">Tanggal Lahir</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mahasiswas as $mahasiswa)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $mahasiswa->nim }}
                            </th>
                            <td class="px-6 py-4">{{ $mahasiswa->nama }}</td>
                            <td class="px-6 py-4">
                                @if ($mahasiswa->kelas)
                                    {{ $mahasiswa->kelas->name }}
                                @else
                                    Kelas belum ditentukan
                                @endif

                            </td>
                            <td class="px-6 py-4">{{ $mahasiswa->tempat_lahir }}</td>
                            <td class="px-6 py-4">{{ $mahasiswa->tanggal_lahir }}</td>
                            <td class="px-6 py-4 relative">
                                <div class="flex space-x-2">
                                    @php
                                        $requestExists = DB::table('request')
                                            ->where('mahasiswa_id', $mahasiswa->id)
                                            ->exists();
                                    @endphp

                                    @if (is_null($mahasiswa->kelas))
                                        <!-- Jika mahasiswa belum memiliki kelas -->
                                        <p class="text-red-600">Anda belum mendapatkan akses. Jika sudah masuk ke kelas
                                            tertentu, Anda dapat meminta request data jika ada kesalahan.</p>
                                    @else
                                        @if ($mahasiswa->edit && !$mahasiswa->is_edited)
                                            <!-- Tampilkan tombol "Edit" jika field edit bernilai true dan belum di-edit -->
                                            <button type="button" onclick="openEditModal({{ json_encode($mahasiswa) }})"
                                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit</button>
                                        @else
                                            @if ($requestExists)
                                                <!-- Tampilkan tombol "Menunggu" jika request sudah dilakukan -->
                                                <button type="button"
                                                    class="text-white bg-yellow-500 cursor-not-allowed font-medium rounded-lg text-sm px-4 py-2 text-center"
                                                    disabled>Menunggu</button>
                                            @else
                                                <!-- Tampilkan tombol "Request" jika belum ada request atau setelah di-edit -->
                                                <button type="button"
                                                    onclick="openRequestModal({{ $mahasiswa->id }}, '{{ $mahasiswa->kelas_id }}')"
                                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Request</button>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="flex flex-col items-center" style="margin-top: 20px;"></div>
        </div>

        <!-- Request Modal -->
        <div id="requestModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-gray-900 bg-opacity-50">
            <!-- Menambahkan properti flex -->
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg w-full">

                <div
                    class="inline-block overflow-hidden transition-all transform bg-white rounded-lg shadow-xl max-w-lg w-full p-6 text-left align-middle">
                    <form id="requestForm" method="POST" action="{{ route('requests.store') }}">
                        @csrf
                        <input type="hidden" name="kelas_id" id="request_kelas_id">
                        <input type="hidden" name="mahasiswa_id" id="request_mahasiswa_id">

                        <div class="mb-4">
                            <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="mt-1 block w-full" rows="4" required
                                placeholder="Masukkan keterangan di sini..." autofocus></textarea>
                        </div>

                        <div class="flex justify-end space-x-4">
                            <button type="button" onclick="closeRequestModal()"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Kembali</button>
                            {{-- <button type="submit" onclick="showPopup({{ $mahasiswa->id }})" --}}
                            <button type="submit" onclick="showPopup({{ $mahasiswa->id }})"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Pop-up -->
        <div id="popup" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-gray-800 bg-opacity-75">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm text-center">
                <p>Request terkirim, menunggu dosen menerima request anda</p>
            </div>
        </div>

        <!-- Edit Modal -->
        <div id="editModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-gray-900 bg-opacity-50">
            <!-- Menambahkan properti flex -->
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg w-full">
                <div class="inline-block overflow-hidden transition-all transform bg-white rounded-lg shadow-xl max-w-lg w-full p-6 text-left align-middle">
                    <form id="editForm" method="POST">
                        @csrf
                        <div>
                            <h4 class="text-xl text-red-500 mb-2 font-bold">Perhatian !!</h4>
                            <ol class="list-decimal list-inside">
                                <li>Anda hanya bisa melakukan edit sebanyak 1 kali.</li>
                                <li>Setelah data dikirim, Anda tidak memiliki akses edit.</li>
                                <li>Koreksi terlebih dahulu data yang ingin Anda ganti.</li>
                            </ol>
                        </div>

                        <!-- Data Mahasiswa -->
                        <div class="mt-4">
                            <h4 class="text-lg font-bold text-gray-800 mb-2">Data Mahasiswa</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="nim" class="block text-sm font-medium text-gray-700">Nomor Induk Mahasiswa</label>
                                    <input type="text" name="nim" id="nim" class="mt-1 block w-full bg-gray-100 text-gray-500" required>
                                </div>
                                
                                <div>
                                    <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
                                    <input type="text" name="kelas" id="kelas" class="mt-1 block w-full bg-gray-100 text-gray-500" readonly>
                                    <input type="hidden" name="kelas_id" id="kelas_id">
                                </div>
                                
                                <div>
                                    <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="mt-1 block w-full" required>
                                </div>
                                
                                <div>
                                    <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="mt-1 block w-full" required>
                                </div>
                                
                                <div class="col-span-2">
                                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama Mahasiswa</label>
                                    <input type="text" name="nama" id="nama" class="mt-1 block w-full" required>
                                </div>
                            </div>
                        </div>

                        <!-- Akun Mahasiswa -->
                        <div class="mt-6">
                            <h4 class="text-lg font-bold text-gray-800 mb-2">Akun Mahasiswa</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="col-span-2">
                                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                                    <input type="text" name="username" id="username" class="mt-1 block w-full" value="{{ $mahasiswa->user->username }}">
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                    <input type="email" name="email" id="email" class="mt-1 block w-full" value="{{ $mahasiswa->user->email }}">
                                </div>

                                <div>
                                    <label for="password_old" class="block text-sm font-medium text-gray-700">Password Lama</label>
                                    <input type="password" name="password_old" id="password_old" class="mt-1 block w-full">
                                </div>

                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                    <input type="password" name="password" id="password" class="mt-1 block w-full">
                                </div>

                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full">
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex justify-end space-x-4 mt-6">
                            <button type="button" onclick="closeEditModal()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Kembali</button>
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <script>
            function openRequestModal(mahasiswaId,
                kelasId) { //Membuka sebuah jendela pop up dengan menerima nilai mahasiswa id dan kelas id   
                //Mencari Nilai html dengan menggunakan getElemenById yang memiliki id dengan nama dibawah ini, diubah menjadi nilai
                document.getElementById('request_mahasiswa_id').value = mahasiswaId;
                document.getElementById('request_kelas_id').value = kelasId;
                document.getElementById('requestModal').classList.remove(
                    'hidden'); //Menghapus Class bernama hidden, agar modal tampil
            }

            function closeRequestModal() {
                document.getElementById('requestModal').classList.add(
                    'hidden'); //Untuk Menutup tampilan modal, dengan menambahkan fungsi class hidden
            }

            function openEditModal(
                mahasiswa) { //Membuka sebuah jendela pop up EditModal, dengan menerima nilai mahasiswa (data mahasiswa)
                //Mengambil scrit html dengan id 'nim', kemudian mengisi input teks tersebut dengan mengisi data nim dari objek mahasiswa
                document.getElementById('nim').value = mahasiswa.nim;
                document.getElementById('nama').value = mahasiswa.nama;
                document.getElementById('kelas').value = mahasiswa.kelas.name; // Pastikan ini sesuai dengan value yang dikirim
                document.getElementById('kelas_id').value = mahasiswa.kelas_id;
                document.getElementById('tempat_lahir').value = mahasiswa.tempat_lahir;
                document.getElementById('tanggal_lahir').value = mahasiswa.tanggal_lahir;
                //Mengatur action dengan id(editForm)
                //action menentukan kearah mana data form akan dikirimkan 
                document.getElementById('editForm').action = '/mahasiswa/' + mahasiswa.id +
                    '/update'; //Dalam hal ini, URL-nya diatur menjadi /mahasiswa/{id}/update
                //di mana {id} adalah ID dari mahasiswa yang sedang diedit.
                document.getElementById('editModal').classList.remove(
                    'hidden'); //Menghapus Class bernama hidden, agar modal tampil
            }

            function closeEditModal() {
                document.getElementById('editModal').classList.add(
                    'hidden'); //Untuk Menutup tampilan modal, dengan menambahkan fungsi class hidden
            }

            function showPopup() {
                const popup = document.getElementById('popup'); //Mengambil id bernama pop Up
                popup.classList.remove('hidden'); //Menghapus Class hiden unutk menampilkan
                setTimeout(function() {
                    popup.classList.add('hidden'); //Menambahkan class hiden untuk menyembunyikan
                }, 2000); // Pop-up ditampilkan selama 3 detik

            }

            // Menangani pengiriman formulir
            document.getElementById('requestForm').addEventListener('submit', function(
                event) { //menambhakan eventlistenet untuk menangani event submit
                event.preventDefault(); // Mencegah pengiriman formulir secara default dan haaman akan direfresh    


                showPopup(); // Tampilkan pop-up

                // Kirim formulir setelah 1 detik/ menunda eksekusi didalamnya
                setTimeout(() => {
                    this.submit(); //elemen formulir dikirim setelah set timeout dieksekusi
                }, 0);
            });
        </script>
    </section>
    <!-- End block -->
@endsection