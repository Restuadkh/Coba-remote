<!-- resources/views/payment_methods/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <h2>Edit Metode Pembayaran</h2>

    <form action="{{ route('payment_methods.update', $paymentMethod->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $paymentMethod->name }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" required>{{ $paymentMethod->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
@endsection
