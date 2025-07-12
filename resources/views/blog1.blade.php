@extends('layouts.app')

@section('title', 'Blog1 • Locomotif Jajar')

@section('content')
 <div class="px-10 py-12 overflow-y-auto max-h-screen">
    <!-- Judul Halaman -->
    <h2 class="text-[24px] text-[#167DD3] text-center font-semibold mb-2">
     THINGS TO READ
    </h2>
    <h1 class="text-[40px] text-black text-center font-bold mb-10">
      We wrote you a worthy blogs
    </h1>

    <!-- Contoh Blog (Hardcoded) -->
    @foreach($blogs as $index => $blog)
      <div class="w-[1212px] h-[298px] bg-[#F5FAFF] rounded-xl flex items-center justify-between mb-10 px-6 py-4 mx-auto">
        @if($index % 2 == 0)
          <!-- Gambar kiri -->
          <div class="w-[492px] h-[257px] bg-gray-300 rounded-md overflow-hidden">
            <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" class="w-full h-full object-cover">
          </div>
          <!-- Konten kanan -->
          <div class="flex flex-col justify-between h-full ml-8">
            <h3 class="text-[24px] font-bold text-black mb-2">{{ $blog->title }}</h3>
            <p class="text-[20px] text-black mb-4">{{ $blog->description }}</p>
            <span class="text-[16px] text-black">Kategori: {{ $blog->category }}</span>
          </div>
        @else
          <!-- Konten kiri -->
          <div class="flex flex-col justify-between h-full mr-8">
            <h3 class="text-[24px] font-bold text-black mb-2">{{ $blog->title }}</h3>
            <p class="text-[20px] text-black">{{ $blog->description }}</p>
          </div>
          <!-- Gambar kanan -->
          <div class="w-[492px] h-[257px] bg-gray-300 rounded-md overflow-hidden">
            <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" class="w-full h-full object-cover">
          </div>
        @endif
      </div>
    @endforeach
  </div>
@endsection
