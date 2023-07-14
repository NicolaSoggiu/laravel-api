@extends('admin.layouts.base')

@section('contents')
    <h1 class="main-title py-3">Edit this project</h1>
    <form method="POST" action="{{ route('admin.projects.update', ['project' => $project]) }}" novalidate>
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input
                type="text"
                class="form-control @error('title') is-invalid @enderror"
                id="title"
                name="title"
                value="{{ old('title', $project->title) }}"
            >
            <div class="invalid-feedback">
                @error('title') {{ $message }} @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select class="form-select" aria-label="Default select example" name="type_id" class="form-control @error('type_id') is-invalid @enderror">
                <option selected>Choose a type...</option>
                @foreach($types as $type)
                    <option  value="{{$type->id}}"@if (old('type_id', $project->type->id) == $type->id) selected @endif>{{$type->name}}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                @error('type_id') {{ $message }} @enderror
            </div>
            </div>

        <div class="mb-3">
            <label for="url_image" class="form-label">Image</label>
            <input 
                type="url"
                class="form-control @error('url_image') is-invalid @enderror"
                id="url_image"
                name="url_image"
                value="{{ old('url_image', $project->url_image) }}"
            >
            <div class="invalid-feedback">
                @error('url_image', $project->url_image) {{ $message }} @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="repo" class="form-label">Repo repo</label>
            <input
                type="text"
                class="form-control @error('repo') is-invalid @enderror"
                id="repo"
                name="repo"
                value="{{ old('repo', $project->repo) }}"
            >
            <div class="invalid-feedback">
                @error('repo') {{ $message }} @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="languages" class="form-label">Languages</label>
            <input
                type="text"
                class="form-control @error('languages') is-invalid @enderror"
                id="languages"
                name="languages"
                value="{{ old('languages', $project->languages) }}"
            >
            <div class="invalid-feedback">
                @error('languages', $project->languages) {{ $message }} @enderror
            </div>
        </div>


        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea
                class="form-control @error('description') is-invalid @enderror"
                id="description"
                rows="3"
                name="description">{{ old('description', $project->description) }}</textarea>
            <div class="invalid-feedback">
                @error('description', $project->description) {{ $message }} @enderror
            </div>
        </div>

        <button class="btn btn-primary">Save</button>
    </form>
@endsection