<?php

namespace App\Http\Controllers;

use App\Order;
use App\Pay;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Whoops\Run;

class PayController extends Controller
{
    public function index()
    {
        $pays = Pay::all();
        return view('pays.index', compact('pays'));
    }

    public function create()
    {
        $order = order::all();
        return view('pays.create', compact('order'));
    }

    public function store(Request $request)
    {
        $length = 10;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = substr(str_shuffle($characters), 0, $length);
        $secret_key = 'Basic ' . config('xendit.key_auth');
        $external_id = 'Invoice_' . $randomString;
        $amount = 0;
        $descripsi = "";
        $order = 0;
        $user = auth()->user()->user_id;
        if ($request->order_id) {
            $order = Order::where('order_id', $request->order_id)
                ->with('user')
                ->with('product')
                ->with('event')
                ->first();
            $user = $order->user->user_id;
            $amount = $order->total_amount;
            $order_id = $order->order_id;
            $descripsi = $order->user->name . " Order " . $order->product->product_name . " untuk " . $order->event->event_name . " di " . $order->event->location;
        } else {
            $amount = $request->biaya;
            $descripsi = "error:" . "[descripsi]:" . $request->descripsi;
        }

        try {
            $data_request = Http::withHeaders([
                'Authorization' => $secret_key
            ])->post('https://api.xendit.co/v2/invoices', [
                'external_id' => $external_id,
                'amount' => $amount,
                // 'payment_methods' => [
                //     'BCA', 'QRIS'
                // ]
            ]);
            $response = $data_request->object();
            try {
                $expirydate = Carbon::parse($response->expiry_date);
                $expiry_date = $expirydate->format('Y-m-d H:i:s');
                $pay = Pay::create([
                    'user_id' => $user,
                    'order_id' => $order_id,
                    'biaya' => $amount,
                    'external_id' => $response->external_id,
                    'description' => $descripsi,
                    'status' => $response->status,
                    'pay_link' => $response->invoice_url,
                    'expiry_date' => $expiry_date,
                ]);
                return redirect($response->invoice_url);
            } catch (\Exception $e) {
                dd($e);
            }
        } catch (\Exception $e) {
            dd($e);
        }
        // return redirect()->route('pays.index')->with('success', 'Data Pay berhasil ditambahkan.');
        // return redirect($response->invoice_url);
    }

    public function callback(Request $request)
    {

        $status = $request->status;
        $external_id = $request->external_id;

        $Pay = Pay::where('external_id', $external_id)->first();

        $order = Order::findorFail($Pay->order_id)->update([
            'order_status' => $status
        ]);

        $Pay->update([
            'status' => $status
        ]);

        return response()->json($Pay);
    }


    public function show($id)
    {
        $pay = Pay::findOrFail($id);
        return view('pays.show', compact('pay'));
    }

    public function edit($id)
    {
        $pay = Pay::findOrFail($id);
        return view('pays.edit', compact('pay'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'biaya' => 'required|integer',
            'deskripsi' => 'required|string',
            'status' => 'required|string',
            'pay_link' => 'required|string',
        ]);

        $pay = Pay::findOrFail($id);
        $pay->update($request->all());

        return redirect()->route('pays.index')->with('success', 'Data Pay berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pay = Pay::findOrFail($id);
        $pay->delete();

        return redirect()->route('pays.index')->with('success', 'Data Pay berhasil dihapus.');
    }
}
