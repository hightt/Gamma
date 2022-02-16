<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            ['user_id' => '1', 'created_at' => '2022-02-09 13:13:30', 'title' => 'What does the fox say?', 'content' => "Integer viverra lacus a ante facilisis laoreet. Sed blandit ultricies feugiat. Quisque vel porta diam. Praesent nec luctus dui, vel iaculis dolor. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. "],
            ['user_id' => '1', 'created_at' => '2022-02-09 13:13:30', 'title' => 'Dokąd nocą tupta jeż?', 'content' => "Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Ut luctus rhoncus dapibus."],
            ['user_id' => '1', 'created_at' => '2022-02-09 13:13:30', 'title' => 'Gdzie śpiewa ptak', 'content' => "Morbi volutpat mi eu sem bibendum, eu suscipit leo hendrerit. Ut faucibus lorem nulla, in molestie nisl lobortis sed."],
            ['user_id' => '1', 'created_at' => '2022-02-09 13:13:30', 'title' => 'Czy pociąg puszcza parę zanim odjedzie?', 'content' => "Etiam eget euismod mauris. Ut et cursus risus, sit amet vehicula velit. Sed pulvinar euismod condimentum."]
        ]);
    }
}
