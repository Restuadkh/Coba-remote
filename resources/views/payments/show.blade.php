<!-- resources/views/payments/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('alert'))
            <div class="alert alert-success">
                {{ session('alert') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="col-md">
            <h2>Detail Pembayaran</h2>
        </div>

        <div class="card">
            <i class="fas fa-caret-square-left"></i>
            <div class="card-body">
                <form action="{{ route('payments.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <h5 class="card-title">Order #{{ $order->order_id }}</h5>

                    <div class="mb-1">
                        {{-- <label for="order_id" class="form-label">Order #</label> --}}
                        <input type="text" class="form-control" id="order_id" name="order_id"
                            value="{{ $order->order_id }}" hidden readonly>
                    </div>

                    <div class="mb-1">
                        <b for="order_id" class="form-label">Events</b>
                        <div class="d-flex">
                            <p class="me-auto">{{ $order->event->event_name }}</p>
                            <p class="ms-auto">Rp. {{ $order->event->event_price }},-</p>
                        </div>
                        {{-- <input type="text" class="form-control" id="event_id" name="event_id"
                            value="{{ $order->event->event_name }}" readonly> --}}
                    </div>


                    <div class="mb-1">
                        <b for="order_id" class="form-label">Product</b>
                        <div class="d-flex">
                            <p class="me-auto">{{ $order->product->product_name }}</p>
                            <p class="ms-auto">Rp. {{ $order->product->price }},-</p>
                        </div>
                        {{-- <input type="text" class="form-control" id="product_id" name="product_id"
                            value="{{ $order->product->product_name }}" readonly> --}}
                    </div>
                    <div class="mb-1">
                        <b for="user_id" class="form-label">Location</b>
                        <div class="d-flex">
                            <p class="ms-auto">{{ $order->shipping_address }}</p>
                        </div>
                        {{-- <input type="text" class="form-control" id="user_id" name="Address"
                            value="{{ $order->shipping_address }}" readonly> --}}
                    </div>
                    <hr>
                    <div class="mb-1">
                        <b for="user_id" class="form-label">Total Pembayaran</b>
                        <div class="d-flex">
                            <p class="ms-auto">Rp. {{ $order->total_amount }},- </p>
                        </div>
                        {{-- <input type="text" class="form-control" id="user_id" name="Total"
                            value="Rp.{{ $order->total_amount }},-" readonly> --}}
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Bayar Sekarang</button>
                    </div>

                </form>
            </div>
            <div class="card-footer d-flex justify-content-center">
                <div class="d-flex">
                    <a href="{{ route('payments.index') }}" class="btn btn-primary">Kembali ke Daftar Pembayaran</a>
                </div>
            </div>
        </div>


    </div>
@endsection
