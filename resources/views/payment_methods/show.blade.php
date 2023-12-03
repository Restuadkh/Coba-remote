<!-- resources/views/payment_methods/show.blade.php -->

@extends('layouts.app')

@section('content')
    <h2>Detail Metode Pembayaran</h2>

    <p><strong>ID:</strong> {{ $paymentMethod->id }}</p>
    <p><strong>Nama:</strong> {{ $paymentMethod->name }}</p>
    <p><strong>Deskripsi:</strong> {{ $paymentMethod->description }}</p>

    <a href="{{ route('payment_methods.edit', $paymentMethod->id) }}" class="btn btn-warning">Edit</a>

    <form action="{{ route('payment_methods.destroy', $paymentMethod->id) }}" method="post" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
    </form>
@endsection
