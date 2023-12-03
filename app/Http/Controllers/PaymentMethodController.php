<?php

namespace App\Http\Controllers;

use App\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $paymentMethods = PaymentMethod::all();
        return view('payment_methods.index', compact('paymentMethods'));
    }

    public function create()
    {
        return view('payment_methods.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
        ]);

        PaymentMethod::create($request->all());

        return redirect()->route('payment_methods.index')->with('success', 'Metode Pembayaran berhasil ditambahkan.');
    }

    public function show(PaymentMethod $paymentMethod)
    {
        return view('payment_methods.show', compact('paymentMethod'));
    }

    public function edit(PaymentMethod $paymentMethod)
    {
        return view('payment_methods.edit', compact('paymentMethod'));
    }

    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $paymentMethod->update($request->all());

        return redirect()->route('payment_methods.index')->with('success', 'Metode Pembayaran berhasil diperbarui.');
    }

    public function destroy(PaymentMethod $paymentMethod)
    {
        $paymentMethod->delete();

        return redirect()->route('payment_methods.index')->with('success', 'Metode Pembayaran berhasil dihapus.');
    }
}
