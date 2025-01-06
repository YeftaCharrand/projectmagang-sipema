{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}

{{-- 
@extends('components.kaprodi')

@section('content')
  <div class="p-6">
      <h1 class="text-3xl font-bold mb-4 text-gray-900 dark:text-white">Selamat Datang, <span id="adminName"></span>!</h1>
      <p class="text-gray-600 dark:text-gray-300">Ini adalah halaman dashboard Kaprodi. Silakan pilih menu di samping untuk mengelola data.</p>
  </div>

  <script>
      const adminName = "Maria Ine"; // Replace with actual admin name from login process
      document.getElementById('adminName').textContent = adminName;
  </script>
@endsection --}}



@extends('components.kaprodi')

@section('content')
    <div class="p-6">
        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-6 rounded-lg shadow-lg mb-6 text-white">
            <div class="flex items-center space-x-4">
                <img src="../../../img/icon.jpg" class="w-12 h-12 rounded-full object-cover" alt="">
                <div>
                    <h1 class="text-3xl font-bold">Selamat Datang, {{ Auth::user()->username }}</h1>
                </div>
            </div>
        </div>
        @if (Auth::user()->role === 'kaprodi')
            <p class="text-gray-600 dark:text-gray-300">Ini adalah halaman dashboard Kaprodi. Silakan pilih menu di samping
                untuk mengelola data.</p>
        @elseif (Auth::user()->role === 'mahasiswa')
            <p class="text-gray-600 dark:text-gray-300">Ini adalah halaman dashboard Mahasiswa. Silakan pilih menu di
                samping
                untuk mengakses informasi perkuliahan Anda.</p>
        @elseif (Auth::user()->role === 'dosen')
            <p class="text-gray-600 dark:text-gray-300">Ini adalah halaman dashboard Dosen. Silakan pilih menu di samping
                untuk mengelola kelas dan mahasiswa.</p>
        @endif
    </div>
@endsection
