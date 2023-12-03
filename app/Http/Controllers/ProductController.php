<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\ProductPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'verified']);
    // }
    public function index()
    {
        $products = Product::with('photos')->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'category_id' => 'required',
        ]);
        try {
            $product = Product::create($request->all());

            $filename = [];
            if ($request->hasfile('photos')) {
                foreach ($request->file('photos') as $photo) {
                    $filename = time() . '_' . $photo->getClientOriginalName();
                    $photo->storeAs('public/product_photos', $filename);
                    $product->photos()->create([
                        'photo_path' => 'product_photos/' . $filename,
                        'product_id' => $product->product_id,
                    ]);
                }
            }

            session()->flash(
                'success',
                'Product berhasil ditambahkan !'
            );

            return redirect()->route('products.index');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }
    /**
     * Display the specified product.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input sesuai kebutuhan Anda
        $request->validate([
            'product_name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'disc_price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'category' => 'required',
        ]);
        $product = Product::findOrFail($id);
        try {
            // Cari produk berdasarkan ID
            $order = Order::where('product_id', $id)->first();
            $order->total_amount = ($order->total_amount - $product->price) + $request->price;
            $order->save();

            // // Update data produk
            $product->update($request->all());
        } catch (\Exception $e) {
            $product->update($request->all());
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }
    public function destroy($id)
    {
        // Cari produk berdasarkan ID dan hapus
        $product = Product::where('product_id', $id)->with('photos')->first();
        foreach ($product->photos as $photo) {
            Storage::delete('public/' . $photo->photo_path);
            $photo->delete();
        }
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
