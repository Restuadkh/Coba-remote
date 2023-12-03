<!-- resources/views/payment_methods/create.blade.php -->

@extends('layouts.app')

@section('content')
    <h2>Tambah Metode Pembayaran</h2>

    <form action="{{ route('payment_methods.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
