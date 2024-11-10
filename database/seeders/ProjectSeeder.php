<?php

namespace Database\Seeders;

use App\Models\Type;
use App\Models\Project;
use App\Functions\Helpers;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Generator as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        //percorso per prendere il file csv
        $csvData = Helpers::getCsv(__DIR__."/projects-list.csv");

        $typeIds = Type::all()->pluck("id");

        foreach($csvData as $indice => $riga){
            if($indice ==! 0){ //diferente de 0 poi ali contèm o nome das propriedades da tabela!
                $newProject = new Project();
                $newProject->type_id = $faker->randomElement($typeIds);
                $newProject->title = $riga[0];
                $newProject->description = $riga[1];
                $newProject->category = $riga[2];
                $newProject->tech_stack = $riga[3];
                $newProject->github_link = $riga[4];
                $newProject->creation_date = $riga[5];
                $newProject->save();
            }
        }
    }
}