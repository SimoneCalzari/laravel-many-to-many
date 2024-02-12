<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $difficulties = ['Beginner', 'Intermediate', 'Advanced'];

        foreach ($difficulties as $difficulty) {
            $type = new Type();
            $type->difficulty = $difficulty;
            $type->is_team_project = random_int(0, 1);
            $type->save();
        }
    }
}
