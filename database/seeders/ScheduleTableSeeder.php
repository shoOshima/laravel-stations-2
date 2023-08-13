<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Movie;
use App\Models\Schedule;
use Carbon\CarbonImmutable;

class ScheduleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $movieId = $this->createMovie()->id;
        $now = CarbonImmutable::now();

        $schedule1 = Schedule::create([
            'movie_id' => $movieId,
            'start_time' => $now->addHours(10),
            'end_time' => $now->addHours(11),
        ]);
        $schedule2 = Schedule::create([
            'movie_id' => $movieId,
            'start_time' => $now->addHours(3),
            'end_time' => $now->addHours(4),
        ]);
        $schedule3 = Schedule::create([
            'movie_id' => $movieId,
            'start_time' => $now->addHours(8),
            'end_time' => $now->addHours(9),
        ]);
    }

    private function createMovie(): Movie
    {
        $genreId = Genre::insertGetId(['name' => 'ジャンル']);
        $movieId = Movie::insertGetId([
            'title' => '最初からある映画',
            'image_url' => 'https://techbowl.co.jp/_nuxt/img/6074f79.png',
            'published_year' => 2000,
            'description' => '概要',
            'is_showing' => false,
            'genre_id' => $genreId,
        ]);
        return Movie::find($movieId);
    }

    private function createSchedule(int $movieId): void
    {
        $count = 10;
        for ($i = 0; $i < $count; $i++) {
            Schedule::insert([
                'movie_id' => $movieId,
                'start_time' => CarbonImmutable::now()->addHours($i),
                'end_time' => CarbonImmutable::now()->addHours($i + 2),
            ]);
        }
    }
}
