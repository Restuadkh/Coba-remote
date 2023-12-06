<!-- resources/views/orders/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        
        <div class="col-md">
            <h2>Buat Pesanan Baru</h2>  
        </div>   
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="col">
            <form action="{{ route('orders.store') }}" method="POST">
                @csrf 
                <!-- Tambahkan input form sesuai dengan atribut yang diperlukan -->
                <div class="form-group mb-3" >
                    <label for="product_id" class="form-label">ID Produk</label>
                    <select class="form-control" id="product_id" name="product_id" required>
                        <option value="" selected disabled>Pilih Produk</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->product_id }}">{{ $product->product_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="user_id" class="form-label">ID Events</label>
                    <select class="form-control" id="event_id" name="event_id" required>
                        <option value="" selected disabled>Pilih Produk</option>
                        @foreach ($events as $event)
                            <option value="{{ $event->event_id }}">{{ $event->event_name }}</option>
                        @endforeach
                    </select>
                </div>  

                {{-- <div class="mb-3">
                    <label for="user_id" class="form-label">Shipping Address</label>
                    <input type="text" class="form-control" id="shipping_address" name="shipping_address" required>
                </div> --}}
                <!-- ...Tambahkan input form lainnya... -->

                <a href="{{ route('orders.index') }}" class="btn btn-secondary">Kembali ke Daftar Pesanan</a>
                <button type="submit" class="btn btn-primary">Buat Pesanan</button>
            </form>
        </div>

    </div>
@endsection
