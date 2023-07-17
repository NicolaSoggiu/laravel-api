<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function index()
    {
        $projects = Project::with("type", "technologies")->paginate(6);
        return response()->json($projects);

    }

    public function show($slug)
    {
        $project = Project::where("slug", $slug)->firstOrFall;
        return response()->json($slug);
    }
}