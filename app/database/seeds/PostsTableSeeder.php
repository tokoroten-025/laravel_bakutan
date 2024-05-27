<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\User;
use Carbon\Carbon;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'user_id'=>'1',
            'title' => '乳頭温泉',
            'num_of_guests' => '4',
            'checkindate' => '2024-06-01',
            'checkoutdate' => '2024-06-02',
            'content' => '一泊二日朝付き ２名様〜貸切風呂あり 禁煙',
            'amount' => '5000',
            'image' => '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'user_id'=>'2',
            'title' => '玉川温泉',
            'num_of_guests' => '4',
            'checkindate' => '2024-06-23',
            'checkoutdate' => '2024-06-25',
            'content' => '2泊3日朝付き ２名様〜',
            'amount' => '8000',
            'image' => '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'user_id'=>'3',
            'title' => '岩室温泉',
            'num_of_guests' => '4',
            'checkindate' => '2024-07-23',
            'checkoutdate' => '2024-06-25',
            'content' => '2泊3日朝付き ２名様〜',
            'amount' => '8000',
            'image' => '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'user_id'=>'4',
            'title' => 'ryugon',
            'num_of_guests' => '4',
            'checkindate' => '2024-06-23',
            'checkoutdate' => '2024-06-25',
            'content' => '2泊3日朝付き ２名様〜',
            'amount' => '8000',
            'image' => '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
