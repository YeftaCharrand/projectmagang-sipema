<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            {{-- <li>
                <a href="{{ route('dashboard') }}" class="flex items-center p-2 rounded-lg dark:text-white {{ request()->routeIs('dashboard') ? 'bg-blue-500 dark:bg-blue-700 text-white' : 'text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700' }} group">
                    <!-- SVG Icon -->
                    <span class="ms-3">Dashboard</span>
                </a>
            </li> --}}
            {{-- ----------------------- KAPRODI -------------------------- --}}
            @if (auth()->user()->role == 'kaprodi')
                <li>
                    <a href="{{ route('dashboard') }}" class="flex items-center p-2 rounded-lg dark:text-white {{ request()->routeIs('dashboard') ? 'bg-blue-500 dark:bg-blue-700 text-white' : 'text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700' }} group">
                        <!-- SVG Icon -->
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dosen.index') }}" class="flex items-center p-2 rounded-lg dark:text-white {{ request()->routeIs('dosen.index') ? 'bg-blue-500 dark:bg-blue-700 text-white' : 'text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700' }} group">
                        <!-- SVG Icon -->
                        <span class="flex-1 ms-3 whitespace-nowrap">Data Dosen</span>
                    </a>
                </li> 
                <li>
                    <a href="{{ route('mhs.index') }}" class="flex items-center p-2 rounded-lg dark:text-white {{ request()->routeIs('mhs.index') ? 'bg-blue-500 dark:bg-blue-700 text-white' : 'text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700' }} group">
                        <!-- SVG Icon -->
                        <span class="flex-1 ms-3 whitespace-nowrap">Data Mahasiswa</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('kelas.index') }}" class="flex items-center p-2 rounded-lg dark:text-white {{ request()->is('kelas') ? 'bg-blue-500 dark:bg-blue-700 text-white' : 'text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700' }} group">
                        <!-- SVG Icon -->
                        <span class="flex-1 ms-3 whitespace-nowrap">Data Kelas</span>
                    </a>
                </li>

                <li>
                    <a href={{ route('plotting.index') }} class="flex items-center p-2 rounded-lg dark:text-white {{ request()->is('plotting') ? 'bg-blue-500 dark:bg-blue-700 text-white' : 'text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700' }} group">
                        <!-- SVG Icon -->
                        <span class="flex-1 ms-3 whitespace-nowrap">Ploting Kelas</span>
                    </a>
                </li>
            @endif

            {{-- --------------------------   DOSEN   ------------------------------ --}}
            @if (auth()->user()->role == 'dosen')
                <li>
                    <a href={{ route('dosenrole.index') }} class="flex items-center p-2 rounded-lg dark:text-white {{ request()->is('dosenrole') ? 'bg-blue-500 dark:bg-blue-700 text-white' : 'text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700' }} group">
                        <!-- SVG Icon -->
                        <span class="flex-1 ms-3 whitespace-nowrap">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href={{ route('dosen.filterByClass') }} class="flex items-center p-2 rounded-lg dark:text-white {{ request()->is('mahasiswa') ? 'bg-blue-500 dark:bg-blue-700 text-white' : 'text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700' }} group">
                        <!-- SVG Icon -->
                        <span class="flex-1 ms-3 whitespace-nowrap">Data Mahasiswa</span>
                    </a>
                </li>
                @if($isDosenWali)
                <li>
                    <a href={{ route('request.index') }} class="flex items-center p-2 rounded-lg dark:text-white {{ request()->is('requestmhs') ? 'bg-blue-500 dark:bg-blue-700 text-white' : 'text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700' }} group">
                        <!-- SVG Icon -->
                        <span class="flex-1 ms-3 whitespace-nowrap">Permintaan Request</span>
                    </a>
                </li>
                @endif
            @endif


            {{-- ---------------------- MAHASISWA ---------------------------- --}}

            @if (auth()->user()->role == 'mahasiswa')
            <li>
                <a href="{{ route('dashboard') }}" class="flex items-center p-2 rounded-lg dark:text-white {{ request()->routeIs('dashboard') ? 'bg-blue-500 dark:bg-blue-700 text-white' : 'text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700' }} group">
                    <!-- SVG Icon -->
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>
                <li>
                    <a href="/profilemahasiswa" class="flex items-center p-2 rounded-lg dark:text-white {{ request()->is('profilemahasiswa') ? 'bg-blue-500 dark:bg-blue-700 text-white' : 'text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700' }} group">
                        <!-- SVG Icon -->
                        <span class="flex-1 ms-3 whitespace-nowrap">Profile Mahasiswa</span>
                    </a>
                </li>
            @endif

            {{-- <li>
                <form method="POST" action="{{ route('logout') }}" class="flex items-center p-2 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    @csrf
                    <button type="submit" class="flex items-center w-full text-left">
                        <!-- SVG Icon -->
                        <span class="flex-1 ms-3 whitespace-nowrap">Log Out</span>
                    </button>
                </form>
            </li> --}}
            
            <!-- Garis Pembatas -->
            <hr class="my-2 border-t border-gray-300 dark:border-gray-600">

            <li>
                <form id="logout-form" method="POST" action="{{ route('logout') }}" class="flex items-center p-2 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    @csrf
                    <button type="button" class="flex items-center w-full text-left" onclick="openLogoutModal()">
                        <!-- SVG Icon -->
                        <span class="flex-1 ms-3 whitespace-nowrap">Log Out</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</aside>