@extends('admin.layouts.base')

@section('contents')
    <div class="container show">
        <h1 class="text-center text-dark py-3">{{$technology->name}}</h1>
        <p>Description : {{$technology->description}}</p>

        <h2 class="text-dark">Projects in this category : </h2>
    <ul>
        @foreach ($technology->projects as $project)
            <li><a href="{{ route('admin.projects.show', ['project' => $project]) }}">{{ $project->title }}</a></li>
        @endforeach
    </ul>
    </div>
@endsection