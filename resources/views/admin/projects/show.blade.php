@extends('admin.layouts.base')

@section('contents')
    <div class="container show">
        <h1 class="text-center py-3">Title : {{$project->title}}</h1>
        <h2 class="text-center py-3"> Repo name : {{$project->repo}}</h2>
        <h5>Type : {{$project->type->name}} </h5>
        <h5>Technologies : {{ implode(', ', $project->technologies->pluck('name')->all()) }}</h5>
        <h5 class="py-4">Languages : {{$project->languages}}</h5>
        <h4>Description :  </h4>
        <p>"{{$project->description}}"</p>
        <h4 class="py-3">See the project :</h4>
        {{-- <div class="container d-flex justify-content-center">
            <img class="py-3" src="{{$project->url_image}}" alt="">
        </div> --}}
        @if ($project->image)
        <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}">
        @endif


    <a class="btn btn-primary" href="{{ route("admin.projects.index") }}">Back to Index</a>

    </div>
@endsection