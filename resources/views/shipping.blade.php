@extends('layouts.app')

@section('title', 'Form Pengiriman • Locomotif Jajar')

@section('content')
<div style="display: flex; justify-content: center; align-items: center; padding: 2.5rem 1rem; min-height: calc(100vh - 200px);">
  <div class="shipping-form-container" style="width: 100%; max-width: 800px; background-color: white; border: 1px solid #E2EAF4; border-radius: 15px; padding: 2.5rem 1rem; box-sizing: border-box;">
    <h2 style="font-size: clamp(18px, 4vw, 20px); text-align: center; font-weight: bold; margin-bottom: 2rem;">Form Pengiriman</h2>

    {{-- Info jika data auto-filled --}}
    @if($profileData)
      <div class="alert-success" style="background-color: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px; padding: 1rem; margin-bottom: 1.5rem;">
        <div style="display: flex; align-items: flex-start;">
          <svg style="width: 20px; height: 20px; color: #16a34a; margin-top: 2px; margin-right: 0.75rem; flex-shrink: 0;" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
          </svg>
          <div>
            <h3 style="color: #166534; font-weight: 600; margin: 0 0 0.25rem 0;">Data Otomatis Terisi</h3>
            <p style="color: #15803d; font-size: 14px; margin: 0;">
              Form telah diisi otomatis berdasarkan profile Anda. Anda dapat mengubahnya jika diperlukan.
            </p>
          </div>
        </div>
      </div>
    @endif

    <form action="{{ route('shipping.store') }}" method="POST" style="display: flex; flex-direction: column; align-items: center;">
      @csrf

      <div class="form-content" style="width: 100%; max-width: 600px; text-align: left;">
        <div style="margin-bottom: 1.5rem;">
          <label for="nama" style="font-size: clamp(16px, 3vw, 20px); font-weight: 600; display: block; margin-bottom: 0.5rem;">Nama Lengkap</label>
          <input 
            type="text" 
            id="nama" 
            name="nama" 
            value="{{ old('nama', $profileData['nama'] ?? '') }}"
            required 
            style="width: 100%; height: 40px; border: 1px solid #789DBC; border-radius: 6px; padding: 0 0.75rem; background-color: white; outline: none; box-sizing: border-box; font-size: 16px;"
          >
          @error('nama')
            <p style="color: #ef4444; font-size: 14px; margin-top: 0.25rem;">{{ $message }}</p>
          @enderror
        </div>

        <div style="margin-bottom: 1.5rem;">
          <label for="alamat" style="font-size: clamp(16px, 3vw, 20px); font-weight: 600; display: block; margin-bottom: 0.5rem;">Alamat</label>
          <textarea 
            id="alamat" 
            name="alamat" 
            required 
            rows="3"
            style="width: 100%; border: 1px solid #789DBC; border-radius: 6px; padding: 0.5rem 0.75rem; background-color: white; outline: none; resize: vertical; box-sizing: border-box; font-size: 16px; min-height: 80px;"
          >{{ old('alamat', $profileData['alamat'] ?? '') }}</textarea>
          @error('alamat')
            <p style="color: #ef4444; font-size: 14px; margin-top: 0.25rem;">{{ $message }}</p>
          @enderror
        </div>

        <div class="form-row" style="display: flex; gap: 1rem; margin-bottom: 1.5rem; flex-wrap: wrap;">
          <div class="form-col" style="flex: 1; min-width: 200px;">
            <label for="provinsi" style="font-size: clamp(16px, 3vw, 20px); font-weight: 600; display: block; margin-bottom: 0.5rem;">Provinsi</label>
            <input 
              type="text" 
              id="provinsi" 
              name="provinsi" 
              value="{{ old('provinsi', $profileData['provinsi'] ?? '') }}"
              required 
              style="width: 100%; height: 40px; border: 1px solid #789DBC; border-radius: 6px; padding: 0 0.75rem; background-color: white; outline: none; box-sizing: border-box; font-size: 16px;"
            >
            @error('provinsi')
              <p style="color: #ef4444; font-size: 14px; margin-top: 0.25rem;">{{ $message }}</p>
            @enderror
          </div>
          <div class="form-col" style="flex: 1; min-width: 200px;">
            <label for="kota" style="font-size: clamp(16px, 3vw, 20px); font-weight: 600; display: block; margin-bottom: 0.5rem;">Kota</label>
            <input 
              type="text" 
              id="kota" 
              name="kota" 
              value="{{ old('kota', $profileData['kota'] ?? '') }}"
              required 
              style="width: 100%; height: 40px; border: 1px solid #789DBC; border-radius: 6px; padding: 0 0.75rem; background-color: white; outline: none; box-sizing: border-box; font-size: 16px;"
            >
            @error('kota')
              <p style="color: #ef4444; font-size: 14px; margin-top: 0.25rem;">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <div class="form-row" style="display: flex; gap: 1rem; margin-bottom: 1.5rem; flex-wrap: wrap;">
          <div class="form-col" style="flex: 1; min-width: 200px;">
            <label for="kecamatan" style="font-size: clamp(16px, 3vw, 20px); font-weight: 600; display: block; margin-bottom: 0.5rem;">Kecamatan</label>
            <input 
              type="text" 
              id="kecamatan" 
              name="kecamatan" 
              value="{{ old('kecamatan', $profileData['kecamatan'] ?? '') }}"
              required 
              style="width: 100%; height: 40px; border: 1px solid #789DBC; border-radius: 6px; padding: 0 0.75rem; background-color: white; outline: none; box-sizing: border-box; font-size: 16px;"
            >
            @error('kecamatan')
              <p style="color: #ef4444; font-size: 14px; margin-top: 0.25rem;">{{ $message }}</p>
            @enderror
          </div>
          <div class="form-col" style="flex: 1; min-width: 200px;">
            <label for="kelurahan" style="font-size: clamp(16px, 3vw, 20px); font-weight: 600; display: block; margin-bottom: 0.5rem;">Kelurahan</label>
            <input 
              type="text" 
              id="kelurahan" 
              name="kelurahan" 
              value="{{ old('kelurahan', $profileData['kelurahan'] ?? '') }}"
              required 
              style="width: 100%; height: 40px; border: 1px solid #789DBC; border-radius: 6px; padding: 0 0.75rem; background-color: white; outline: none; box-sizing: border-box; font-size: 16px;"
            >
            @error('kelurahan')
              <p style="color: #ef4444; font-size: 14px; margin-top: 0.25rem;">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <div style="margin-bottom: 1.5rem;">
          <label for="telepon" style="font-size: clamp(16px, 3vw, 20px); font-weight: 600; display: block; margin-bottom: 0.5rem;">Nomor Telepon</label>
          <input 
            type="text" 
            id="telepon" 
            name="telepon" 
            value="{{ old('telepon', $profileData['telepon'] ?? '') }}"
            required 
            style="width: 100%; height: 40px; border: 1px solid #789DBC; border-radius: 6px; padding: 0 0.75rem; background-color: white; outline: none; box-sizing: border-box; font-size: 16px;"
          >
          @error('telepon')
            <p style="color: #ef4444; font-size: 14px; margin-top: 0.25rem;">{{ $message }}</p>
          @enderror
        </div>
      </div>

      <div style="padding-top: 2rem; width: 100%; text-align: center;">
        <button type="submit" class="submit-button" style="width: 100%; max-width: 390px; height: 60px; background-color: #E2EAF4; border-radius: 8px; font-size: clamp(18px, 3vw, 24px); font-weight: 600; border: none; cursor: pointer; transition: all 0.2s ease; touch-action: manipulation;">
          Proses Pembayaran
        </button>
      </div>
    </form>

    {{-- Link to Profile --}}
    @auth
      @if(!$profileData)
        <div style="text-align: center; margin-top: 1.5rem;">
          <p style="color: #6b7280; font-size: 14px; margin-bottom: 0.5rem;">Ingin mempercepat proses checkout di masa depan?</p>
          <a href="{{ route('user.profile') }}" style="color: #789DBC; font-weight: 500; text-decoration: none; display: inline-block; padding: 0.5rem;">
            Isi Profile Anda →
          </a>
        </div>
      @endif
    @endauth
  </div>
</div>

<style>
  /* Focus states */
  input:focus, textarea:focus {
    border-color: #6366f1 !important;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1) !important;
  }
  
  /* Button hover and active states */
  .submit-button:hover {
    opacity: 0.9;
    transform: translateY(-1px);
  }

  .submit-button:active {
    transform: translateY(0px);
    opacity: 0.8;
  }
  
  /* Link hover */
  a:hover {
    color: #6b8bb3 !important;
  }

  /* Responsive breakpoints */
  @media (max-width: 768px) {
    .shipping-form-container {
      padding: 1.5rem 1rem !important;
      margin: 0 0.5rem !important;
    }

    .form-row {
      flex-direction: column !important;
      gap: 1rem !important;
    }

    .form-col {
      min-width: auto !important;
    }

    .submit-button {
      height: 50px !important;
    }
  }

  @media (max-width: 480px) {
    .shipping-form-container {
      padding: 1rem 0.75rem !important;
      border-radius: 10px !important;
    }

    .alert-success {
      padding: 0.75rem !important;
    }

    .alert-success h3 {
      font-size: 14px !important;
    }

    .alert-success p {
      font-size: 12px !important;
    }

    input, textarea {
      height: 44px !important;
      font-size: 16px !important; /* Prevents zoom on iOS */
    }

    textarea {
      min-height: 88px !important;
    }
  }

  /* Touch device optimizations */
  @media (hover: none) and (pointer: coarse) {
    .submit-button {
      -webkit-tap-highlight-color: rgba(0, 0, 0, 0.1);
    }

    input, textarea {
      -webkit-appearance: none;
      -webkit-border-radius: 6px;
    }
  }
</style>
@endsection