<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;

    //!Relaçao many to many com Project
    public function projects() // sao tantos projetos por isso escreve no plural
    {
        return $this->belongsToMany(Project::class);
    }
}