<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Team;
use Carbon\Carbon;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = [
            [
                'id' => 1,
                'user_id' => 1,
                'name' => "Admin's Team",
                'personal_team' => 1,
                'created_at' => Carbon::now(),
            ]
        ];
        Team::insert($teams);
    }
}
