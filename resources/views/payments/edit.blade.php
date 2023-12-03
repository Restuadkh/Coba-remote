<!-- resources/views/payments/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="col-md">
        <h2>Edit Pembayaran</h2>
    </div> 
    <form action="{{ route('payments.update', $payment->payment_id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Tambahkan input form sesuai dengan atribut yang diperlukan -->
        <div class="mb-3">
            <label for="order_id" class="form-label">ID Pesanan</label>
            <input type="text" class="form-control" id="order_id" name="order_id" value="{{ $payment->order_id }}" required>
        </div>

        <div class="mb-3">
            <label for="user_id" class="form-label">ID User</label>
            <input type="text" class="form-control" id="user_id" name="user_id" value="{{ $payment->user_id }}" required>
        </div>

        <!-- ...Tambahkan input form lainnya... -->

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>

    <a href="{{ route('payments.index') }}" class="btn btn-secondary">Kembali ke Daftar Pembayaran</a>
@endsection
