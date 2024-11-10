<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectTechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        //Recupero os dados das tabelas que devo relacionar
        $projects = Project::all();
        $technologies = Technology::all()->pluck('id');

        //Tabela principal dos dados
        foreach ($projects as $project){
             $project->technologies()->sync($faker->randomElements($technologies, rand(1,3)));
        }

    }
}