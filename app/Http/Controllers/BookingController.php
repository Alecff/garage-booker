<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use DateInterval;
use DateTimeImmutable;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function getBookings(Request $request): JsonResponse
    {
        $query = $request->query();
        if (!isset($query['date'])) {
            $bookings = Booking::all();

            return new JsonResponse($bookings);
        }

        $date = new DateTimeImmutable($query['date']);
        // Fetch all bookings made on the given day
        $bookings = Booking::where('booking_datetime', '>=', $date)
            ->where('booking_datetime', '<', $date->add(DateInterval::createFromDateString('1 day')))
            ->get();

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
                'booking_datetime' => new DateTimeImmutable($data['booking_datetime']),
            ]);

            $this->validateDateTime($booking);
        } catch (Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 400);
        }

        $booking->save();

        return new JsonResponse([
            'booking_id' => $booking->id,
            'booking_datetime' => $booking->booking_datetime,
        ]);
    }

    /**
     * @throws Exception
     */
    private function validateDateTime(Booking $booking): void
    {
        /** @var DateTimeImmutable $datetime */
        $datetime = $booking->booking_datetime;
        if (
            (int) $datetime->format('i') !== 00 &&
            (int) $datetime->format('i') !== 30
        ) {
            throw new Exception('Bookings must be on the hour or 30 minutes past.');
        }

        $existingBooking = Booking::firstWhere(['booking_datetime' => $datetime]);

        if ($existingBooking !== null) {
            throw new Exception('Appointment already exists with this datetime.');
        }
    }
}
