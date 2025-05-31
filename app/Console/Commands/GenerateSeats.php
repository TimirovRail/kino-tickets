<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Models\Seat;
use Illuminate\Console\Command;

class GenerateSeats extends Command
{
    protected $signature = 'generate:seats {event_id} {rows} {seats_per_row}';
    protected $description = 'Generate seats for an event';

    public function handle()
    {
        $eventId = $this->argument('event_id');
        $rows = strtoupper($this->argument('rows')); // Ряды (A, B, C, ...)
        $seatsPerRow = $this->argument('seats_per_row');

        $event = Event::find($eventId);

        if (!$event) {
            $this->error("Event with ID {$eventId} not found.");
            return;
        }

        // Ensure rows is a valid letter or sequence of letters
        if (!ctype_alpha($rows)) {
            $this->error("Rows must be letters");
            return;
        }

        $rowsArray = str_split($rows);

        // Convert seats_per_row to a valid number
        if (!is_numeric($seatsPerRow) || $seatsPerRow <= 0) {
            $this->error("Seats per row must be a positive number");
            return;
        }

        for ($i = 0; $i < count($rowsArray); $i++) {
            $rowLetter = $rowsArray[$i];
            for ($j = 1; $j <= $seatsPerRow; $j++) {
                $seatNumber = $rowLetter . $j;

                Seat::create([
                    'event_id' => $event->id,
                    'seat_number' => $seatNumber,
                    'is_reserved' => false,
                ]);
            }
        }

        $this->info("Seats generated for event {$event->title}.");
    }
}