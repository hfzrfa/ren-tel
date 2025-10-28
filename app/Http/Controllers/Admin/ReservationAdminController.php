<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationAdminController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('car')->orderByDesc('created_at')->paginate(20);
        return view('admin.reservations.index', compact('reservations'));
    }

    public function edit(Reservation $reservation)
    {
        return view('admin.reservations.edit', compact('reservation'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $data = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
            'total_price' => 'nullable|numeric|min:0',
        ]);
        $reservation->update($data);
        return redirect()->route('admin.reservations.index')->with('status', 'Reservation updated');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('admin.reservations.index')->with('status', 'Reservation deleted');
    }
}
