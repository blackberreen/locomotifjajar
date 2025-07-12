{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('title', 'Home • Locomotif Jajar')

@section('content')
  <div class="flex flex-wrap items-center justify-center text-center">
    <div class="w-full lg:w-2/3 flex flex-col items-center">
      <h1 class="text-[45px] font-bold mb-6 leading-snug">
        <span class="text-primary">Modifikasi</span> motor anda dengan<br>
        Aman dan Terpercaya di Bengkel<br>
        <span class="text-primary">Locomotif Jajar.</span>
      </h1>

      <a
        href="https://wa.me/628176820332"
        class="w-[360px] h-[80px] flex items-center justify-center rounded-lg font-medium bg-light hover:opacity-90 text-[25px] mb-8"
      >
        Mulai mengobrol
      </a>

      <div class="flex flex-wrap justify-center gap-6">
        <div class="w-[289px] h-[181px] p-4 rounded-lg bg-light flex items-center justify-center">
          <p class="font-semibold text-[25px] text-center">Aman, Cepat, dan Terpercaya sejak 2005</p>
        </div>
        <div class="w-[289px] h-[181px] p-4 rounded-lg bg-light flex items-center justify-center">
          <p class="font-semibold text-[25px] text-center">Sudah menangani 1000+ motor</p>
        </div>
      </div>
    </div>

    <div class="w-full lg:w-1/3 mt-10 lg:mt-0 flex justify-center">
      <img
        src="{{ asset('img/coverhome.jpeg') }}"
        alt="Cover Home"
        class="w-[525px] h-[548px] object-cover rounded-lg"
      />
    </div>
  </div>
@endsection
