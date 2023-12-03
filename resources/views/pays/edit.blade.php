<!-- resources/views/pays/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container"> 
        <div class="col-md">
            <h2>Edit Pay</h2>
        </div> 
        <form action="{{ route('pays.update', $pay->pay_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="biaya">Biaya:</label>
                <input type="text" class="form-control" id="biaya" name="biaya" value="{{ $pay->biaya }}" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{ $pay->deskripsi }}" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <input type="text" class="form-control" id="status" name="status" value="{{ $pay->status }}" required>
            </div>
            <div class="form-group">
                <label for="pay_link">Pay Link:</label>
                <input type="text" class="form-control" id="pay_link" name="pay_link" value="{{ $pay->pay_link }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
@endsection
