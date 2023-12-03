<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Event;
use App\User;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::all();
        return view('bookings.index', compact('bookings'));
    }

    // Menampilkan form untuk membuat booking baru
    public function create()
    {
        $events = Event::all();
        $users = User::all();
        return view('bookings.create', compact('events', 'users'));
    }

    // Menyimpan booking baru ke dalam database
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'event_id' => 'required',
            'booking_date' => 'required|date',
            'number_of_tickets' => 'required|integer',
            'total_price' => 'required|numeric',
            'payment_status' => 'required',
        ]);

        Booking::create($request->all());

        return redirect()->route('bookings.index')
            ->with('success', 'Booking berhasil ditambahkan.');
    }

    // Menampilkan detail booking
    public function show($id)
    {
        $booking = Booking::find($id);
        return view('bookings.show', compact('booking'));
    }

    // Menampilkan form untuk mengedit booking
    public function edit($id)
    {
        $booking = Booking::find($id);
        $events = Event::all();
        $users = User::all();
        return view('bookings.edit', compact('booking', 'events', 'users'));
    }

    // Mengupdate booking di dalam database
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'event_id' => 'required',
            'booking_date' => 'required|date',
            'number_of_tickets' => 'required|integer',
            'total_price' => 'required|numeric',
            'payment_status' => 'required',
        ]);

        Booking::find($id)->update($request->all());

        return redirect()->route('bookings.index')
            ->with('success', 'Booking berhasil diperbarui.');
    }

    // Menghapus booking dari database
    public function destroy($id)
    {
        Booking::find($id)->delete();

        return redirect()->route('bookings.index')
            ->with('success', 'Booking berhasil dihapus.');
    }
}
