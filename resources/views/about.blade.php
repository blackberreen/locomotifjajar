@extends('layouts.app')

@section('title', 'about • Locomotif Jajar')

@section('content')
<div class="flex flex-col items-center py-12 px-6">
    <!-- OUR STORY Title -->
    <h1 class="text-[40px] font-bold mb-6">
        <span class="text-[#167DD3]">OUR</span> STORY
    </h1>

    <!-- Description -->
    <p class="text-[24px] text-center max-w-4xl leading-relaxed mb-10">
        Pendiri bengkel kami, yaitu Bapak Muhamad Deni, mendirikan bengkel ini dengan ide dari guru las nya dahulu.
        Banyaknya pasang surut yang dialami beliau, tidak menggoyahkan keinginan beliau untuk terus memajukan bengkel yang berdiri sejak 1998 ini.
        Berkat kegigihan beliau, kepercayaan pelanggan, dan kehendak Tuhan, Bengkel Locomotif Jajar ini sudah berdiri selama 20 Tahun.
    </p>

    <img 
        src="{{ asset('img/coveraboutus.jpeg') }}" 
        alt="Sejarah Bengkel Locomotif Jajar" 
        class="w-[891px] h-[383px] object-cover rounded-md"
    />

</div>
@endsection


