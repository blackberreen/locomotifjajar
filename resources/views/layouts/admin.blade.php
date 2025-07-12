<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - Locomotif</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-white font-sans">
    <nav class="flex justify-between items-center px-10 py-4 border-b-4 border-[#789DBC] bg-white">
        <div class="text-3xl font-bold">Locomotif</div>
        <ul class="flex gap-10 text-lg">
            <li><a href="{{ route('admin.home') }}" class="hover:underline">Beranda</a></li>
            <li><a href="{{ route('admin.booking') }}" class="hover:underline">Reservasi</a></li>
            <li><a href="{{ route('admin.product') }}" class="hover:underline">Produk</a></li>
            <li><a href="{{ route('admin.payment') }}" class="hover:underline">Pembayaran</a></li>
            <li><a href="{{ route('admin.order') }}" class="hover:underline">Pesanan</a></li>
            <li>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="hover:underline text-left">Keluar</button>
                </form>
            </li>

        </ul>
    </nav>

    <div class="p-10">
        @yield('content')
    </div>
</body>
</html>

