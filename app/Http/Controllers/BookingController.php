<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function getBookings(Request $request): JsonResponse
    {
        $bookings = Booking::all();

        return new JsonResponse($bookings);
    }

    public function createBooking(Request $request): JsonResponse
    {
        $booking = new Booking([
            'name' => 'test',
            'email' => 'test',
            'phone_number' => 'test',
            'vehicle_make_model' => 'test',
            'booking_datetime' => new \DateTimeImmutable('2024-01-29'),
        ]);

        $booking->save();

        return new JsonResponse($booking->get('id'));
    }
}
