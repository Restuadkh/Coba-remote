<!-- resources/views/users/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md">
            <h2>Edit Pengguna</h2>
        </div>
        <div class="col-md">
            <form action="{{ route('users.update', $user->user_id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Tambahkan input form sesuai dengan atribut yang diperlukan -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="is_admin" name="is_admin"
                        {{ $user->is_admin ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_admin">Admin</label>
                </div>
                
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="number" class="form-control" id="phone_number" name="phone_number">
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
        <div class="col-md">
            <hr>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali ke Manajemen Pengguna</a>
        </div>
    </div>
@endsection
