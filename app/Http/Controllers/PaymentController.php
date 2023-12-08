<?php

namespace App\Http\Controllers;

use App\Order;
use App\Pay;
use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {

        if (auth()->user()->is_admin) {
            $payments = Payment::all();
        } else {
            $payments = Payment::where('user_id', auth()->user()->user_id)->get();
        }
        return view('payments.index', ['payments' => $payments]);
    }

    public function show($id)
    {
        $order = Order::find($id)
            ->with('event')
            ->with('product')
            ->first();
        // dd($order);
        // $payment = Payment::findOrFail($id);
        return view('payments.show', [
            // 'payment' => $payment,
            'order' => $order
        ]);
    }

    public function create()
    {
        // Tampilkan formulir pembuatan pembayaran
        return view('payments.create');
    }

    public function store(Request $request)
    {

        // dd($request->all());

        $length = 10;
        $characters = '0123456789';
        $random = substr(str_shuffle($characters), 0, $length);

        $order = Order::findorFail($request->order_id)->first();
        $payment = '';

        // Validasi input
        // $request->validate([
        // Atur aturan validasi sesuai kebutuhan            
        // 'order_id' => 'required|exists:orders,order_id',
        // 'user_id' => 'required|exists:users,user_id',
        // 'event_id' => 'nullable|exists:events,event_id',
        // 'booking_id' => 'nullable|exists:bookings,id',
        // 'payment_method_id' => 'required|exists:payment_methods,id',
        // 'payment_date' => 'required|date',
        // 'payment_amount' => 'required|numeric|min:0.01',
        // 'payment_status' => 'required|string',
        // 'transfer_path' => 'nullable|string',
        // 'transaction_id' => 'required|string',
        // ...
        // ]);
        try {
            $payment = Payment::create([
                'order_id' => $order->order_id,
                'user_id' => $order->user_id,
                'event_id' => $order->event_id,
                'payment_method_id' => 1,
                'payment_date' => $order->order_date,
                'payment_amount' => $order->total_amount,
                'payment_status' => $order->order_status,
                // 'transfer_path' => $request->transfer_path,
                // 'transaction_id' => $request->transaction_id,
            ]);
            try {
                $pays = new PayController();
                $pay = $pays->store($request);

                session()->flash('success', 'Pesan error' . $pay);
                // return redirect()->back();
                return redirect($pay->getTargetUrl());
            } catch (\Exception $e) {
                $payment->delete();

                return redirect()->back()->with('error', $e);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e);
        }

        // Simpan pembayaran baru ke database  
    }

    public function edit($id)
    {
        $payment = Payment::findOrFail($id);
        return view('payments.edit', ['payment' => $payment]);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            // Atur aturan validasi sesuai kebutuhan
            'order_id' => 'required',
            'user_id' => 'required',
            'event_id' => 'nullable',
            'booking_id' => 'nullable',
            'payment_date' => 'required',
            'payment_amount' => 'required',
            'payment_status' => 'required',
            'payment_method' => 'required',
            'transaction_id' => 'required',
            // ...
        ]);

        // Temukan dan perbarui pembayaran yang ada di database
        $payment = Payment::findOrFail($id);
        $payment->update($request->all());

        // Redirect dengan pesan sukses
        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Temukan dan hapus pembayaran dari database
        $payment = Payment::findOrFail($id);
        $payment->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil dihapus.');
    }
}
