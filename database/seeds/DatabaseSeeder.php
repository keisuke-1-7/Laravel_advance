<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()　//seederを実行することでこのファンクションが呼び出されて、結局UsersTableSeederが呼び出されて実行される？
    {
        $this->call(UsersTableSeeder::class);
    }
}
