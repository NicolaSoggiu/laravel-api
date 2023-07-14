<?php

namespace Database\Seeders;
use App\Models\Type;
use App\Models\Project;
use App\Models\Technology;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $types = Type::all();
        $types->shift();

        $technologies = Technology::all()->pluck('id');
        // $technologies = Technology::all();
        for ($i = 0; $i < 50; $i++) {
            $title = $faker->words(rand(2, 10), true);  // Il mio titolo è questo
            $slug = Project::slugger($title);
            
            $project = Project::create([
                'type_id' => $faker->randomElement($types)->id,
                'title' => $title,
                "slug"  => $slug,
                'url_image'=> $faker->imageUrl(640, 480, 'animals', true),
                'repo'=>  $faker->word(),
                'languages'=> $faker->sentence(),
                'description'=> $faker->paragraph(),
                
            ]);

            $project->technologies()->sync($faker->randomElements($technologies, null));
        }
    }
}