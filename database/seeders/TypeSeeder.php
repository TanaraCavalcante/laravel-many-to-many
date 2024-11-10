<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypeSeeder extends Seeder
{

    public function run(): void
    {
        $types = [
            "Front-end",
            "Back-end",
            "Full-stack",
            "Database"
        ];

        foreach($types as $type){
            $newType= new Type();
            $newType->name = $type;
            $newType->save();
        }
    }
}