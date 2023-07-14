@extends('admin.layouts.base')

@section('contents')
    <div class="container show">
        <h1 class="text-center text-dark py-3">{{$type->name}}</h1>
        <p>Description : {{$type->description}}</p>

        <h2 class="text-dark">Projects in this category : </h2>
    <ul>
        @foreach ($type->projects as $project)
            <li><a href="{{ route('admin.projects.show', ['project' => $project->id]) }}">{{ $project->title }}</a></li>
        @endforeach
    </ul>
    </div>
@endsection