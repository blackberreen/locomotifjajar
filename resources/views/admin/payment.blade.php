<!-- Ganti bagian ini -->
<p style="font-weight: bold; margin-top: 20px;">
    Semua informasi yang anda kirimkan bersifat rahasia
</p>

<form action="{{ route('payment.submit') }}" method="POST" style="margin-top: 20px;">
    @csrf

    <label for="account_name" style="display: block; margin-bottom: 8px; font-weight: bold;">
        Nama Pemilik Rekening
    </label>
    <input type="text" name="account_name" id="account_name" 
        style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 15px;">

    <button type="submit"
        style="background-color: #167DD3; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
        Kirim Nama Pemilik Rekening
    </button>

    @if($errors->any())
        <p style="color: red; margin-top: 10px;">{{ $errors->first() }}</p>
    @endif
</form>
