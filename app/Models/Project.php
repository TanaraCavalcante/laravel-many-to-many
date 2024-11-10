<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "description",
        "category",
        "tech_stack",
        "type_id", //!Dados da tabela secundaria
        "github_link",
        "creation_date"
    ];

     //! Relaçao "one to Many" com Project
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}