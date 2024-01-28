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
        try {
            $data = $request->all();

            $booking = new Booking([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone_number' => $data['phone_number'],
                'vehicle_make_model' => $data['vehicle_make_model'],
                'booking_datetime' => new \DateTimeImmutable($data['booking_datetime']),
            ]);

            $existingBooking = Booking::firstWhere(['booking_datetime' => $data['booking_datetime']]);

            if ($existingBooking !== null) {
                throw new \Exception('Appointment already exists with this datetime.');
            }
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 400);
        }

        $booking->save();

        return new JsonResponse([
            'booking_id' => $booking->id,
            'booking_datetime' => $booking->booking_datetime,
        ]);
    }
}
