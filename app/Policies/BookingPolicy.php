<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given booking can be viewed by the user.
     */
    public function view(User $user, Booking $booking)
    {
        return $user->id === $booking->user_id;
    }

    /**
     * Determine if the user can update the booking.
     */
    public function update(User $user, Booking $booking)
    {
        return $user->id === $booking->user_id;
    }

    /**
     * Determine if the user can delete the booking.
     */
    public function delete(User $user, Booking $booking)
    {
        return $user->id === $booking->user_id;
    }
}
