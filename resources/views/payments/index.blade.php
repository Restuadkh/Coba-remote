<!-- resources/views/payments/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md">
            <h2>Daftar Pembayaran</h2>
        </div> 
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table id="Payments" class="">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID Pesanan</th>
                    <th>ID User</th>
                    <th>Tanggal Pembayaran</th>
                    <th>Jumlah Pembayaran</th>
                    <th>Status Pembayaran</th>
                    <th>Metode Pembayaran</th> 
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $payment)
                    <tr>
                        <td>{{ $payment->payment_id }}</td>
                        <td>{{ $payment->order_id }}</td>
                        <td>{{ $payment->user_id }}</td>
                        <td>{{ $payment->payment_date }}</td>
                        <td>{{ $payment->payment_amount }}</td>
                        <td>{{ $payment->payment_status }}</td>
                        <td>{{ $payment->payment_method->name }}</td> 
                        <td> 
                            <a href="{{ route('payments.edit', $payment->payment_id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('payments.destroy', $payment->payment_id) }}" method="POST"
                                style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus pembayaran ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('payments.create') }}" class="btn btn-success">Buat Pembayaran Baru</a>
        <script>
            new DataTable("#Payments");
        </script>
    </div>
@endsection
