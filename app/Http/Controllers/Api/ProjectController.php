<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function index(Request $request)
    {
        // filtro dei risultati
        $searchString = $request->query("q", "");

        $projects = Project::with("type", "technologies")->where("title", "LIKE", "%${searchString}%")->paginate(6);
        
        return response()->json([
            "success"       =>  true,
            "results"       =>  $projects,
        
        ]);

    }

    public function show($slug)
    {
        $project = Project::where("slug", $slug)->first();
        
        return response()->json([
            "success"        =>    $project ? true : false,
            "results"        =>    $project,
        ]);
    }
}