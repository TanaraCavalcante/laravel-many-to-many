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

     //! Relaçao "one to Many" com Type
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

     //! Relaçao "many to Many" com Technology
     public function technology()
     {
         return $this->belongsTo(Technology::class);
     }
}