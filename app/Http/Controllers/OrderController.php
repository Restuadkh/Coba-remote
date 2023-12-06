<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Event;
use App\Order;
use App\Payment;
use App\PaymentMethod;
use App\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware(['auth', 'verified']);
    // }
    public function index()
    {
        $orders = Order::all();
        return view('orders.index', ['orders' => $orders]);
    }

    public function show($id)
    {
        $payment_method = PaymentMethod::all();
        $order = Order::findOrFail($id);
        return view('orders.show', ['order' => $order, 'payment_method' => $payment_method]);
    }

    public function create()
    {
        // Tampilkan formulir pembuatan pesanan
        $events = Event::all();
        $products = Product::all();
        return view('orders.create', ['events' => $events, 'products' => $products]);
    }

    public function store(Request $request)
    { 
        // Validasi input
        $validator = $request->validate([
            // Atur aturan validasi sesuai kebutuhan
            'product_id' => 'required|exists:products,product_id', // Memastikan product_id ada dalam tabel products
            // 'user_id' => 'required|exists:users,user_id', // Memastikan user_id ada dalam tabel users
            'event_id' => 'nullable|exists:events,event_id', // Memastikan event_id ada dalam tabel events jika diisi 
            // 'total_amount' => 'required|numeric|min:0', // Memastikan total_amount adalah angka positif
            // 'shipping_address' => 'required|string|max:255', // Memastikan shipping_address adalah string dengan panjang maksimal 255 karakter
            // ...
        ]);
        // if ($validator) {
        //     return redirect()->back()->with('error', $validator);
        // }

        // Simpan pesanan baru ke database
        $product = Product::findOrFail($request->product_id);
        $event = Event::findOrFail($request->event_id);
        // dd($product);
        $amount = $product->price + $event->event_price;

        $order = new Order;
        $order->product_id = $request->product_id;
        $order->user_id = auth()->user()->user_id;
        $order->event_id = $request->event_id;
        $order->order_date = Carbon::parse(now()->format('Y-m-d H:i:s'));
        $order->total_amount = $amount;
        $order->order_status = "PENDING";
        $order->shipping_address = $event->location;
        $order->save();
        // dd($order->save());
        // Redirect dengan pesan sukses
        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat.');
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $events = Event::all();
        $products = Product::all();
        return view('orders.edit', ['order' => $order,  'events' => $events, 'products' => $products]);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            // Atur aturan validasi sesuai kebutuhan
            'product_id' => 'required',
            'user_id' => 'required',
            'event_id' => 'nullable',
            'order_date' => 'required',
            'total_amount' => 'required',
            'order_status' => 'required',
            'shipping_address' => 'required',
            // ...
        ]);

        // Temukan dan perbarui pesanan yang ada di database
        $order = Order::findOrFail($id);
        $order->update($request->all());

        // Redirect dengan pesan sukses
        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Temukan dan hapus pesanan dari database
        $order = Order::findOrFail($id);
        $order->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}
