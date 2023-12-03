<!-- resources/views/orders/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        
        <div class="col-md">
            <h2>Daftar Pesanan</h2>
        </div> 

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table id="Orders" class=" ">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Tanggal Pesanan</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->order_id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->order_date }}</td>
                        <td>{{ $order->total_amount }}</td> 
                        <td class="text-center">
                            @if ($order->order_status == 'PENDING')
                                <div class="bg-warning p-2">{{ $order->order_status }}</div>
                            @else
                                <div class="bg-success text-white  p-2">{{ $order->order_status }}</div>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('payments.show', $order->order_id) }}" class="btn btn-success">Bayar</a>
                            <a href="{{ route('orders.edit', $order->order_id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('orders.destroy', $order->order_id) }}" method="POST"
                                style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('orders.create') }}" class="btn btn-success">Buat Pesanan Baru</a>
        <script>
            $(document).ready(function() {
                new DataTable('#Orders');  
            });
        </script>
    </div>
@endsection
