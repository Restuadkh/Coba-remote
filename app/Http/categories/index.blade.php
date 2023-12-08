@extends('layouts.app')

@section('content')
    <div class="container">

        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        <h1>Categories</h1>


        <table id="Categories" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->category_name }}</td>
                        <td>{{ $category->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>{{ $category->updated_at->format('Y-m-d H:i:s') }}</td>
                        <td>
                            {{-- <a href="{{ route('categories.show', $category) }}" class="btn btn-info">Show</a> --}}
                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('categories.create') }}" class="btn btn-success">Create new category</a>

        <script>
            $(document).ready(function() {
                new DataTable('#Categories');
            });
        </script>
    </div>
@endsection
