<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\User;
use Carbon\Carbon;

class BookingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bookings')->insert([
            'user_id'=>'1',
            'post_id'=>'1',
            'tel'=>'090-9990-4567',
            'email' => 'sample987@gmail.com',
            'num_of_guests' => '3',
            'checkindate' => '2024-06-01',
            'checkoutdate' => '2024-06-02',
            'reservation_datetime' => Carbon::now(),
        ]);
    }
}
