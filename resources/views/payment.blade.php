@extends('layouts.app')

@section('title', 'Payment • Locomotif Jajar')

@section('content')
<div style="width: 1091px; height: 786px; background-color: white; border: 2px solid #E2EAF4; border-radius: 15px; margin: 5px auto; padding: 40px; text-align: center;">
    <h2 style="font-size: 24px;">Proses Pembayaran</h2>
    <p style="font-size: 20px;">Pembayaran hanya dapat dilakukan dengan metode Transfer ke</p>

    <div style="display: flex; justify-content: center; gap: 50px; margin: 20px 0;">
        <div style="width: 424px; height: 126px; border: 1px solid black; display: flex; align-items: center; justify-content: center; font-size: 24px;">
            <div>
                <strong>Bank BCA</strong><br>
                7651430961<br>
                A/N Ghieta Maureen
            </div>
        </div>
        <div>
            <p style="font-size: 24px;">Dengan Total Belanjaan anda, yaitu:</p>
            <div style="width: 408px; height: 76px; border: 1px solid black; display: flex; align-items: center; justify-content: center; font-size: 32px;">
                Rp. {{ number_format($total, 0, ',', '.') }}
            </div>
        </div>
    </div>

    <p style="font-size: 24px;">Pembayaran dilakukan maksimal <strong>1 hari</strong> setelah proses pembelian</p>
    <p style="font-size: 20px;">Pesanan otomatis gagal jika pembeli membayar lewat dari tanggal yang ditentukan.</p>
    <p style="font-size: 24px; color: #910A0A;"><strong>PERHATIAN!!</strong></p>
    <p style="font-size: 20px;">Wajib mengirim Bukti Pembayaran<br>Dibawah ini</p>

    <form action="{{ route('payment.store') }}" method="POST" enctype="multipart/form-data" style="margin-top: 30px;">
        @csrf

        <!-- hidden file input -->
        <input 
            type="file" 
            name="bukti_transfer" 
            id="bukti_transfer" 
            required 
            style="display:none;"
        >

        <!-- custom button -->
        <button 
            type="button" 
            style="width: 390px; height: 144px; background-color: #E2EAF4; font-size: 20px; border: none; border-radius: 10px; cursor: pointer;"
            onclick="document.getElementById('bukti_transfer').click()"
        >
            Klik untuk masukkan foto
        </button>

        <!-- file name -->
        <p id="file-name" style="margin-top: 15px; font-size: 18px; color: #333;">Belum ada file yang dipilih</p>

        <!-- submit button -->
        <button type="submit" style="margin-top: 30px; font-size: 20px; padding: 12px 40px; border-radius: 8px; background-color: #167DD3; color: white; border: none; cursor: pointer;">
            Kirim Bukti Pembayaran
        </button>

        @if($errors->any())
            <p style="color:red; margin-top: 20px;">{{ $errors->first() }}</p>
        @endif
    </form>

    <p style="font-size: 24px; margin-top: 50px;"><strong>Terima kasih telah berbelanja di Locomotif Online Store.</strong></p>
</div>

<script>
    const fileInput = document.getElementById('bukti_transfer');
    const fileNameDisplay = document.getElementById('file-name');

    fileInput.addEventListener('change', function() {
        if (fileInput.files.length > 0) {
            fileNameDisplay.textContent = 'File terpilih: ' + fileInput.files[0].name;
        } else {
            fileNameDisplay.textContent = 'Belum ada file yang dipilih';
        }
    });
</script>
@endsection

