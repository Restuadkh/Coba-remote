<!-- resources/views/pays/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="col-md">
            <h2>Tambah Pay</h2>
        </div>
        <form action="{{ route('pays.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="biaya">Biaya:</label>
                <input type="text" class="form-control" id="biaya" name="biaya" required>
            </div>
            <div class="mb-3">
                <label for="product_id" class="form-label">ID Order</label>
                <select class="form-select" id="product_id" name="product_id" required>
                    <option value="" selected disabled>Pilih Order</option>
                    @foreach ($order as $orders)
                        <option value="{{ $orders->order_id }}">{{ $orders->order_date }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="descripsi">descripsi:</label>
                <input type="text" class="form-control" id="descripsi" name="descripsi" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
