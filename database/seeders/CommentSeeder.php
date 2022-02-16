<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            ['user_id' => '1', 'created_at' => '2022-02-09 13:13:30', 'post_id' => 1, 'content' => "Integer viverra lacus a ante facilisis laoreet. Sed blandit ultricies feugiat. Quisque vel porta diam. Praesent nec luctus dui, vel iaculis dolor. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. "],
            ['user_id' => '2', 'created_at' => '2022-02-09 13:13:30', 'post_id' => 1, 'content' => "Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Ut luctus rhoncus dapibus."],
            ['user_id' => '2', 'created_at' => '2022-02-09 13:13:30', 'post_id' => 1, 'content' => "Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Ut luctus rhoncus dapibus."],
        ]);
    }
}
