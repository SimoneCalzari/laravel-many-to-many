<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
            $technology->slug = Str::of($technology->name)->slug();
            $technology->save();
        };
    }
}
