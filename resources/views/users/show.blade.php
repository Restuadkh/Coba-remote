<!-- resources/views/users/show.blade.php -->

@extends('layouts.app')

@section('content') 
    <div class="col-md">
        <h2>Detail Pengguna</h2>
    </div> 
    <div>
        <strong>ID:</strong> {{ $user->user_id }}<br>
        <strong>Nama:</strong> {{ $user->name }}<br>
        <strong>Email:</strong> {{ $user->email }}<br>
        <strong>Tanggal Pendaftaran:</strong> {{ $user->created_at }}<br>
        <strong>Admin:</strong> {{ $user->is_admin ? 'Ya' : 'Tidak' }}<br>
        <!-- Tambahkan atribut pengguna lainnya sesuai kebutuhan -->
    </div>

    <a href="{{ route('users.index') }}" class="btn btn-primary">Kembali ke Manajemen Pengguna</a>
@endsection
