<?php

namespace Database\Seeders;

use App\Practice;
use App\Models\Movie;
use App\Models\Schedule;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call(ScheduleTableSeeder::class);
      Schedule::factory(30)->create();
      $this->call(SheetTableSeeder::class);
      
    }
}
