<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = ['HTML', 'CSS', 'JS', 'Bootstrap', 'Vue', 'PHP', 'Laravel'];

        foreach ($technologies as $technology_el) {
            $technology = new Technology();
            $technology->name = $technology_el;
            $technology->save();
        };
    }
}
