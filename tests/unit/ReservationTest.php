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

        $reservation = new Reservation($tickets, 'john@example.com');

        $this->assertEquals(3600, $reservation->totalCost());
    }

    /** @test */
    function retrieving_the_reservations_tickets()
    {
        $tickets = collect([
            (object) ['price' => 1200],
            (object) ['price' => 1200],
            (object) ['price' => 1200],

        ]);

        $reservation = new Reservation($tickets, 'john@example.com');

        $this->assertEquals($tickets, $reservation->tickets());
    }

    /** @test */
    function retrieving_the_customers_email()
    {

        $reservation = new Reservation(collect(), 'john@example.com');

        $this->assertEquals('john@example.com', $reservation->email());
    }

    /** @test */
    function reserved_tickets_are_released_when_reservation_is_canceled()
    {

        $tickets = collect([
            Mockery::spy(Ticket::class)->shouldReceive('release')->once()->getMock(),
            Mockery::spy(Ticket::class)->shouldReceive('release')->once()->getMock(),
            Mockery::spy(Ticket::class)->shouldReceive('release')->once()->getMock(),
        ]);

        $reservation = new Reservation($tickets,'john@example.com');

        $reservation->cancel();

        foreach($tickets as $ticket) {
            $ticket->shouldHaveReceived('release');
        }


    }
}