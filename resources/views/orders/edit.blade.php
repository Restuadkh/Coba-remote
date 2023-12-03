<!-- resources/views/orders/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container"> 
        <div class="col-md">
            <h2>Edit Pesanan</h2>
        </div>   
        <form action="{{ route('orders.update', $order->order_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="product_id" class="form-label">ID Produk</label>
                <select class="form-select" id="product_id" name="product_id" required>
                    <option value="" selected disabled>Pilih Produk</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->product_id }}">{{ $product->product_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="user_id" class="form-label">ID Events</label>
                <select class="form-select" id="event_id" name="event_id" required>
                    <option value="" selected disabled>Pilih Produk</option>
                    @foreach ($events as $event)
                        <option value="{{ $event->event_id }}">{{ $event->event_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="user_id" class="form-label">Shipping Address</label>
                <input type="text" class="form-control" id="shipping_address" name="shipping_address" required>
            </div>

            <!-- ...Tambahkan input form lainnya... -->
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Kembali ke Daftar Pesanan</a>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
@endsection
