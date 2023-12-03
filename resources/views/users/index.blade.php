<!-- resources/views/users/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container"> 
        <div class="col-md">
            <h2>Manajemen Pengguna</h2>
        </div> 
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table id="Users" class=" ">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Tanggal Pendaftaran</th>
                    <th>Admin</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->user_id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->is_admin ? 'Ya' : 'Tidak' }}</td>
                        <td>
                            <a href="{{ route('users.show', $user->user_id) }}" class="btn btn-info">Lihat</a>
                            <a href="{{ route('users.edit', $user->user_id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('users.destroy', $user->user_id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('users.create') }}" class="btn btn-success">Tambah Pengguna Baru</a>
        <script>
            new DataTable('#Users');
        </script>
    </div>
@endsection
