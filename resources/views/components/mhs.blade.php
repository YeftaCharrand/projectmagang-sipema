<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    <title>SIPEMA</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    <style>
        .active {
            background-color: #007bff; /* Warna latar belakang biru */
            color: #ffffff; /* Warna teks putih */
        }
    </style>
</head>
<body>
    @include('components.partials.navbar')
    @include('components.partials.sidebar')

    <div class="sm:ml-64">
        <div class="border-gray-200 rounded-lg dark:border-gray-700 mt-14">
            @yield('content')
        </div>
    </div>

    <!-- Load Flowbite JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <x-logout>
        {{-- LOG OUT MODAL --}}
    </x-logout>
</body>
</html>