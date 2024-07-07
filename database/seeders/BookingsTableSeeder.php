<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Bookable;
use App\Models\Booking;

class BookingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bookable::all()->each(function(Bookable $bookable){
            $booking = Booking::factory()->make();
            $bookings = collect([$booking]);

            for($i = 0; $i < random_int(1,20); $i++){
               $from = (clone $booking->to)->addDays(random_int(1,14));
               $to = (clone $from)->addDays(random_int(0,14));

               $booking = Booking::make([
                     'from' => $from,
                     'to'   => $to
               ]);

               $bookings->push($booking);
            }

            $bookable->bookings()->saveMany($bookings);
        });
    }
}
