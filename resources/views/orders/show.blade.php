<!-- resources/views/orders/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detail Pesanan</h1>

        <div>
            <strong>ID:</strong> {{ $order->order_id }}<br>
            <strong>User:</strong> {{ $order->user->name }}<br>
            <strong>Produk:</strong> {{ $order->product_id }}<br>
            <strong>Tanggal Pesanan:</strong> {{ $order->order_date }}<br>
            <strong>Total Harga:</strong> {{ $order->total_amount }}<br>
            <strong>Status:</strong> {{ $order->order_status }}<br>
            <strong>Alamat Pengiriman:</strong> {{ $order->shipping_address }}<br>
            <!-- Tambahkan atribut pesanan lainnya sesuai kebutuhan -->
        </div>

        <a href="{{ route('orders.index') }}" class="btn btn-primary">Kembali ke Daftar Pesanan</a>
    </div>
@endsection
