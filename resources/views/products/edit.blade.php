<!-- resources/views/products/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md">
            <h2>Edit Product</h2>
        </div>
        <form action="{{ route('products.update', $product->product_id) }}" method="post">
            @csrf
            @method('PUT')
            @foreach ($product->photos as $photo)
                <img src="{{ asset($photo->photo_path) }}" alt="Product Photo" style="width:50px">
            @endforeach
            <div class="mb-3">
                <label for="photos" class="form-label">Foto Produk</label>
                <input type="file" class="form-control" id="photos" name="photos[]" multiple>
            </div>
            <div class="mb-3">
                <label for="product_name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="product_name" name="product_name"
                    value="{{ $product->product_name }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" required>{{ $product->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01"
                    value="{{ $product->price }}" required>
            </div>
            <div class="mb-3">
                <label for="disc_price" class="form-label">Discounted Price</label>
                <input type="number" class="form-control" id="disc_price" name="disc_price" step="0.01"
                    value="{{ $product->disc_price }}" required>
            </div>
            <div class="mb-3">
                <label for="stock_quantity" class="form-label">Stock Quantity</label>
                <input type="number" class="form-control" id="stock_quantity" name="stock_quantity"
                    value="{{ $product->stock_quantity }}" required>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <input type="text" class="form-control" id="category_id" name="category_id"
                    value="{{ $product->category_id }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
    </div>
@endsection
