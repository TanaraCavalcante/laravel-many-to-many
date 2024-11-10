<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->constrained()->after("id"); //campo que serà chave de colegamento com Types
            $table->string('title'); // Título do projeto
            $table->text('description')->nullable(); // Descrição do projeto
            $table->string('category')->nullable(); // Tipo de tecnologia
            $table->string('tech_stack')->nullable(); // Tecnologias usadas no projeto
            $table->string('github_link')->nullable(); // Link do repositório no GitHub
            $table->date('creation_date')->nullable();// Dia de criaçao do projeto
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};