@extends('layouts.admin')

@section('title', 'Edit Produk • Locomotif Jajar')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-white">
    <form action="{{ route('admin.product.update', $produk->id_produk) }}" method="POST" enctype="multipart/form-data" 
        class="w-[711px] h-[740px] border border-[#789DBC] rounded-lg p-10 relative">
        @csrf
        @method('PUT')

        <!-- Icon Silang untuk Kembali -->
        <a href="{{ route('admin.product') }}" 
           class="absolute top-4 right-4 text-[#789DBC] hover:text-red-500 transition-colors duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </a>

        <h1 class="text-2xl font-bold mb-6">EDIT PRODUK</h1>

        <!-- Nama Produk -->
        <label for="nama" class="block text-[24px] font-semibold text-left mb-1">Nama Produk</label>
        <input type="text" name="nama" id="nama" value="{{ old('nama', $produk->nama) }}"
            class="w-[575px] h-[37px] border border-[#789DBC] rounded px-3 mb-5">

        <!-- Kategori -->
        <label for="kategori" class="block text-[24px] font-semibold text-left mb-1">Kategori</label>
        <input type="text" name="kategori" id="kategori" value="{{ old('kategori', $produk->kategori) }}"
            class="w-[575px] h-[37px] border border-[#789DBC] rounded px-3 mb-5">

        <!-- Harga -->
        <label for="harga" class="block text-[24px] font-semibold text-left mb-1">Harga</label>
        <input type="number" name="harga" id="harga" value="{{ old('harga', $produk->harga) }}"
            class="w-[575px] h-[37px] border border-[#789DBC] rounded px-3 mb-5">

        <!-- Stok -->
        <label for="stok" class="block text-[24px] font-semibold text-left mb-1">Stok Produk</label>
        <input type="number" name="stok" id="stok" value="{{ old('stok', $produk->stok) }}"
            class="w-[575px] h-[37px] border border-[#789DBC] rounded px-3 mb-5">

        <!-- Foto Produk Lama -->
        <label class="block text-[24px] font-semibold text-left mb-1">Foto Produk Sebelumnya</label>
        @if($produk->foto)
            <img src="{{ asset('storage/' . $produk->foto) }}" alt="Foto Produk Lama"
                class="w-[150px] h-[100px] object-cover border border-gray-300 rounded mb-4">
        @else
            <p class="text-gray-500 mb-4">Tidak ada foto</p>
        @endif

        <!-- Upload Foto Baru -->
        <label for="foto" class="block text-[24px] font-semibold text-left mb-1">Upload Foto Baru</label>
        <input type="file" name="foto" id="foto"
            class="w-[575px] h-[37px] border border-[#789DBC] rounded px-3 mb-8 bg-white text-gray-600">

        <!-- Submit Button -->
        <button type="submit"
            class="w-[251px] h-[78px] bg-[#E2EAF4] text-black font-semibold rounded shadow hover:bg-[#d1deed]">
            Edit Produk
        </button>
    </form>
</div>
@endsection