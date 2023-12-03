<!-- resources/views/payment_methods/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h2>Metode Pembayaran</h2>

    <a href="{{ route('payment_methods.create') }}" class="btn btn-primary">Tambah Metode Pembayaran</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($paymentMethods as $paymentMethod)
                <tr>
                    <td>{{ $paymentMethod->id }}</td>
                    <td>{{ $paymentMethod->name }}</td>
                    <td>{{ $paymentMethod->description }}</td>
                    <td>
                        <a href="{{ route('payment_methods.show', $paymentMethod->id) }}" class="btn btn-info">Lihat</a>
                        <a href="{{ route('payment_methods.edit', $paymentMethod->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('payment_methods.destroy', $paymentMethod->id) }}" method="post" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
