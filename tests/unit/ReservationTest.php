<?php

use App\Ticket;
use App\Reservation;

class ReservationTest extends TestCase
{

    /** @test */
    function calculating_total_cost()
    {
        $tickets = collect([
            (object) ['price' => 1200],
            (object) ['price' => 1200],
            (object) ['price' => 1200],

        ]);

        $reservation = new Reservation($tickets);

        $this->assertEquals(3600, $reservation->totalCost());
    }
}