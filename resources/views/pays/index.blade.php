<!-- resources/views/pays/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md">
            <h2>Data Pays</h2>
        </div>
        <a href="{{ route('pays.create') }}" class="btn btn-primary">Tambah Pay</a>
        <table id="Pays" class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Deskripsi</th>
                    <th>Status</th>
                    <th>Biaya</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pays as $pay)
                    <tr>
                        <td>{{ $pay->pay_id }}</td>
                        <td>{{ $pay->external_id }}</td>
                        <td>{{ $pay->description }}</td>
                        <td class="text-center">
                            @if ($pay->status == 'PENDING')
                                <div class="bg-warning rounded p-2">{{ $pay->status }}</div>
                            @else
                                <div class="bg-success rounded text-white  p-2">{{ $pay->status }}</div>
                            @endif
                        </td>
                        <td>Rp.{{ $pay->biaya }},-</td>
                        <td>
                            @if ($pay->status == 'PENDING')
                                <a href="{{ $pay->pay_link }}" class="btn btn-success">Bayar</a>
                            @else
                            @endif
                            <a href="{{ route('pays.show', $pay->pay_id) }}" class="btn btn-info">Lihat</a>
                            {{-- <a href="{{ route('pays.edit', $pay->pay_id) }}" class="btn btn-warning">Edit</a> --}}
                            {{-- <form action="{{ route('pays.destroy', $pay->pay_id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <script>
            new DataTable("#Pays");
        </script>
    </div>
@endsection
