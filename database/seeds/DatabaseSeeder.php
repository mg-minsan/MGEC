<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\User::class, 10)->create();
        factory(App\Attendance\Attendance::class, 10)->create();
        factory(App\Attendance\Trip::class, 10)->create();
        factory(App\Attendance\RollCall::class, 10)->create();
    }
}
