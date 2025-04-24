<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Show the booking create form.
     *
     * @return void
     */
    public function create()
    {
        return view('bookings.create');
    }

    /**
     * Store booking details.
     *
     * @return void
     */
    public function store(StoreBookingRequest $request)
    {
        $data = $request->all();

        $conflicts = Booking::where('booking_date', $data['booking_date'])
            ->where(function ($q) use ($data) {
                if ($data['booking_type'] === 'full_day') {
                    $q->whereNotNull('id');
                } elseif ($data['booking_type'] === 'half_day') {
                    $q->where(function ($q2) use ($data) {
                        $q2->where('booking_type', 'full_day')
                            ->orWhere(function ($q3) use ($data) {
                                $q3->where('booking_type', 'half_day')
                                    ->where('booking_slot', $data['booking_slot']);
                            })
                            ->orWhere(function ($q4) use ($data) {
                                $q4->where('booking_type', 'custom')
                                    ->whereTime('booking_from', '<', $data['booking_slot'] === 'first_half' ? '12:00:00' : '17:00:00')
                                    ->whereTime('booking_to', '>', $data['booking_slot'] === 'first_half' ? '08:00:00' : '13:00:00');
                            });
                    });
                } else {
                    $q->where(function ($q5) use ($data) {
                        $q5->where('booking_type', 'full_day')
                            ->orWhere(function ($q6) use ($data) {
                                $q6->where('booking_type', 'half_day')
                                    ->where(function ($q7) use ($data) {
                                        return $data['booking_from'] < '12:00:00'
                                            ? $q7->where('booking_slot', 'first_half')
                                            : $q7->where('booking_slot', 'second_half');
                                    });
                            })
                            ->orWhere(function ($q8) use ($data) {
                                $q8->where('booking_type', 'custom')
                                    ->whereTime('booking_from', '<', $data['booking_to'])
                                    ->whereTime('booking_to', '>', $data['booking_from']);
                            });
                    });
                }
            })->exists();

        if ($conflicts) {
            return back()->withErrors(['conflict' => 'Booking time already taken!']);
        }

        Booking::create(array_merge($data, ['user_id' => auth()->id()]));

        return redirect()->route('bookings.create')->with('success', 'Booking successful');
    }
}
