<?php

namespace App\Http\Controllers\Admin;

use auth;
use App\Models\Type;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view("admin.index", compact("projects"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $project = new Project();
        $types = Type::all();
        // Passar todos os usuários e tecnologias para a view many-to many
         $technologies = Technology::all();
        return view("admin.create", compact("project","types","technologies"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validaçao dos dados fornecidos pelo utente
        $formData = $request->validate([
            "title" => "required|string|min:2|max:255", //uma stringa con min 4 caracter max 255, pois no db è un VARCHAR(255)
            "description" => "required|string|min:6|max:255",
            "category" => "required|string|min:2|max:255",
            "type_id"=>"required|numeric|integer|exists:types,id", //!Tabela secundaria
            "tech_stack" => "required|string|min:2|max:255",
            "github_link" => "required|url",
            "creation_date" => "required|date",
        ]);

        $formData = $request->all();
        $newProject = Project::create($formData);

        return redirect()->route("admin.show", ["id"=>$newProject->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //TODO $project = Project::findOrFail($id); ---- metodo anterior sem a many-to-many

        //!relacao many to many com tecnologies
        $project = Project::with('technologies')->findOrFail($id);

        return view("admin.show", compact("project"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::with('technologies')->findOrFail($id);
        $types = Type::all(); //one to may
        $technologies = Technology::all(); //many to many
        return view("admin.edit", compact("project","types","technologies"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validaçao dos dados fornecidos pelo utente
        $formData = $request->validate([
            "title" => "required|string|min:2|max:255", //uma stringa con min 4 caracter max 255, pois no db è un VARCHAR(255)
            "description" => "required|string|min:6|max:255",
            "category" => "required|string|min:2|max:255",
            "type_id"=>"required|numeric|integer|exists:types,id", //!Tabela secundaria
            "tech_stack" => "required|string|min:2|max:255",
            "github_link" => "required|url",
            "creation_date" => "required|date",
            //! dados da many to many com technologies
            'technologies' => 'required|array',  // O campo 'technologies' deve ser um array de IDs
            'technologies.*' => 'exists:technologies,id',  // Cada ID de tecnologia deve existir na tabela 'technologies'

        ]);

        $formData = $request->all();
        $project = Project::findOrFail($id);

        $project->title = $formData["title"];
        $project->description = $formData["description"];
        $project->category = $formData["category"];
        $project->category = $formData["type_id"];  //!Tabela secundaria
        $project->tech_stack = $formData["tech_stack"];
        $project->github_link = $formData["github_link"];
        $project->creation_date = $formData["creation_date"];
        $project->update();

        // Sincronizar as tecnologias com o projeto
        $project->technologies()->sync($request->technologies);  // 'sync' vai atualizar a tabela intermediária 'project_technology'


        return redirect()->route("admin.show", ["id"=>$project->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return redirect()->route("admin.index");
   }
}