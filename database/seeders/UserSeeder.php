<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['name' => 'admin', 'email' => 'admin@o2.pl', 'permissions' => '1', 'password' => '$2y$10$w9pa5ohXy0PI0NcD4aTuBOF4gHIymNp.b1saOUuL4bWtSvfKRWVhi'],
            ['name' => 'user', 'email' => 'user@o2.pl', 'permissions' => '0', 'password' => '$2y$10$w9pa5ohXy0PI0NcD4aTuBOF4gHIymNp.b1saOUuL4bWtSvfKRWVhi'],
            ['name' => 'test', 'email' => 'test@o2.pl', 'permissions' => '0', 'password' => '$2y$10$w9pa5ohXy0PI0NcD4aTuBOF4gHIymNp.b1saOUuL4bWtSvfKRWVhi'],
            ['name' => 'Kinga F', 'email' => 'kinga@o2.pl', 'permissions' => '0', 'password' => '$2y$10$w9pa5ohXy0PI0NcD4aTuBOF4gHIymNp.b1saOUuL4bWtSvfKRWVhi'],
            ['name' => 'Konrad D', 'email' => 'konrad@o2.pl', 'permissions' => '0', 'password' => '$2y$10$w9pa5ohXy0PI0NcD4aTuBOF4gHIymNp.b1saOUuL4bWtSvfKRWVhi']
        ]);
    }
}
