<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class BookingController extends Controller
{
    public function create()
    {
        // Include price_per_day so the booking view can display pricing
        $cars = Car::query()
            ->orderBy('name')
            ->get(['id', 'name', 'price_per_day']);

        return view('book', [
            'cars' => $cars,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_id' => ['required','exists:cars,id'],
            'pickup_date' => ['required','date','after_or_equal:today'],
            'pickup_time' => ['required'],
            'return_date' => ['required','date','after_or_equal:pickup_date'],
            'return_time' => ['required'],
            'pickup_method' => ['required','in:self_pickup,delivery'],
            'delivery_address' => ['nullable','string','required_if:pickup_method,delivery','max:500'],
            'gps_location' => ['nullable','string','max:255','required_if:pickup_method,delivery'],
            'full_name' => ['required','string','max:255'],
            'email' => ['required','email'],
            'phone' => ['nullable','string','max:50'],
        ]);

        $user = Auth::user();

        if ($user) {
            $today = Carbon::today();

            $hasActiveReservation = Reservation::query()
                ->where('user_id', $user->id)
                ->where(function ($query) use ($today) {
                    $query
                        ->whereIn('status', ['pending', 'confirmed'])
                        ->orWhere(function ($q) use ($today) {
                            $q->where('status', 'completed')
                              ->whereDate('return_date', '>=', $today);
                        });
                })
                ->exists();

            if ($hasActiveReservation) {
                return back()
                    ->withErrors([
                        'booking' => 'You already have an active booking. You can create a new booking after the current booking is approved and the rental period has ended.',
                    ])
                    ->withInput();
            }
        }

        // Compute total price: price_per_day × days
        $car = Car::findOrFail($validated['car_id']);
        $start = Carbon::parse($validated['pickup_date']);
        $end = Carbon::parse($validated['return_date']);
        $days = max(1, $start->diffInDays($end));
        $total = ((float) ($car->price_per_day ?? 0)) * $days;

        $pickupLocation = $validated['pickup_method'] === 'delivery'
            ? ($validated['gps_location'] ?? 'Delivery location not set')
            : 'Rental office';

        $reservation = Reservation::create([
            'car_id' => $validated['car_id'],
            'user_id' => Auth::id(),
            // For security, always use authenticated user's name/email rather than trusting form values
            'full_name' => $user?->name ?? $validated['full_name'],
            'email' => $user?->email ?? $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'pickup_location' => $pickupLocation,
            'pickup_date' => $validated['pickup_date'],
            'pickup_time' => $validated['pickup_time'],
            'pickup_method' => $validated['pickup_method'],
            'delivery_address' => $validated['delivery_address'] ?? null,
            'return_date' => $validated['return_date'],
            'return_time' => $validated['return_time'],
            'status' => 'pending',
            'total_price' => $total,
        ]);

        return redirect()->route('booking.success')->with('reservation_id', $reservation->id);
    }

    public function success()
    {
        $id = session('reservation_id');
        return view('book-success', ['reservationId' => $id]);
    }

    public function mine()
    {
        $reservations = Reservation::with('car')
            ->where('user_id', Auth::id())
            ->latest('pickup_date')
            ->paginate(10);

        return view('booking-mine', [
            'reservations' => $reservations,
        ]);
    }
}
