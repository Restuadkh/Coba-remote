<!-- resources/views/pays/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container"> 
        <div class="col-md">
            <h2>Detail Pay</h2>
        </div> 
        <ul>
            <li><strong>ID:</strong> {{ $pay->pay_id }}</li>
            <li><strong>Biaya:</strong> {{ $pay->biaya }}</li>
            <li><strong>Deskripsi:</strong> {{ $pay->deskripsi }}</li>
            <li><strong>Status:</strong> {{ $pay->status }}</li>
            <li><strong>Pay Link:</strong> {{ $pay->pay_link }}</li>
        </ul>
        <a href="{{ route('pays.index') }}" class="btn btn-primary">Kembali</a>
    </div>
@endsection
