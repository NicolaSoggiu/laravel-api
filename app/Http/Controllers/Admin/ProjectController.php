<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    // validazioni racchiuse in variabili private

    private $validations = [
            'title'=> 'required|string|min:5|max:100',
            'type_id' =>'required|integer|exists:types,id',
            'url_image'=> 'required|url|max:200',
            'image'=> 'nullable|image|max:1024',
            'repo'=> 'required|string|min:5|max:100',
            'languages'=> 'required|string|min:5|max:100',
            'description'=> 'required|string|min:5',
    ];

    private $validation_messages = [
            'required' => 'il campo è obbligatorio',
            'min' => 'il campo contrassegnato richiede :min caratteri',
            'max' => 'il campo contrassegnato richiede :max caratteri',
            'url' => 'il campo contrassegnato deve essere un url valido',
            'exists' => 'il campo non è valido',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $projects = Project::paginate(10);
       
       return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', "technologies"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate($this->validations, $this->validation_messages);

        $data = $request->all();

        $imagePath = Storage::put('uploads', $data['image']);

        $newProject = new Project();
        $newProject->title          = $data['title'];
        $newProject->slug           = Project::slugger($data["title"]);
        $newProject->type_id        = $data['type_id'];
        $newProject->url_image      = $data['url_image'];
        $newProject->repo           = $data['repo'];
        $newProject->languages      = $data['languages'];
        $newProject->description    = $data['description'];
        $newProject->image          = $imagePath;
        $newProject->save();

        $newProject->technologies()->sync($data["technologies"] ?? []);


        // ridirezionare su una rotta di tipo get
        return to_route('admin.projects.show', ['project' => $newProject]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $project = Project::where("slug", $slug)->firstOrFail();
        return view('admin.projects.show', compact('project'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {

        $project = Project::where("slug", $slug)->firstOrFail();

        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', "technologies"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)

    {

        $project = Project::where("slug", $slug)->firstOrFail();

        $request->validate($this->validations, $this->validation_messages);
        
        // richiedere($data) e validare i dati del form
        $data = $request->all();

        if($data["image"]) {
            $imagePath = Storage::put("uploads", $data["image"]);
            if($project->image) {
                Storage::delete($project->image);
            }
            $project->image = $imagePath;
        }

        // salvare i dati se corretti
        $project->title = $data['title'];
        $project->type_id = $data['type_id'];
        $project->url_image = $data['url_image'];
        $project->repo = $data['repo'];
        $project->languages = $data['languages'];
        $project->description = $data['description'];
        $project->update();

        $project->technologies()->sync($data["technologies"] ?? []);

        // ridirezionare su una rotta di tipo get
        return to_route('admin.projects.show', ['project' => $project]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if ($project->image) {
            Storage::delete($project->image);
        }

        // dissociare tutti i tag
        $project->technologies()->detach();

        // eliminare il portfolio

        $project->delete();

        return to_route('admin.projects.index')->with('delete_success', $project);
    }
}