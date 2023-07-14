<?php

namespace Database\Seeders;

use Faker\Generator;
use App\Models\Technology;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectTechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Generator $faker)
    {
        $technologies = [
            [
                "name"          => "laravel",
            ],
            [
                "name"          => "php", 
            ],
            [
                "name"          => "Js",
            ],
            [
                "name"          => "react",
            ],
            [
                "name"          => "bootstrap",
            ],
            [
                "name"          => "angular",
            ],
            [
                "name"          => "scss",
            ],
            [
                "name"          => "vue",
            ],
            [
                "name"          => "html",
            ],
        ];

        foreach($technologies as $technology) {
            Technology::create($technology);
        }
    }
}