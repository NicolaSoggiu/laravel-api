@extends('admin.layouts.base')

@section('contents')
    <h1 class="main-title py-3">Add new project</h1>
    <form method="POST" action="{{ route('admin.projects.store') }}" novalidate enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title : </label>
            <input
                type="text"
                class="form-control @error('title') is-invalid @enderror"
                id="title"
                name="title"
                value="{{ old('title') }}"
            >
            <div class="invalid-feedback">
                @error('title') {{ $message }} @enderror
            </div>
        </div>

        <div class="input-group mb-3">
            <input type="file" class="form-control" id="image" name="image/*">
            <label class="input-group-text @error('image') is-invalid @enderror" for="image">Upload</label>
            @error ("image")
                <div class="invalid-feedback ">
                    {{ $message }}
                </div>
            @enderror
          </div>

        <div class="mb-3">
        <label for="type" class="form-label">Type : </label>
        <select class="form-select" aria-label="Default select example" name="type_id" class="form-control @error('type_id') is-invalid @enderror">
            <option selected>Choose a type...</option>
            @foreach($types as $type)
                <option value="{{$type->id}}">{{$type->name}}</option>
            @endforeach
        </select>
        <div class="invalid-feedback">
            @error('type_id') {{ $message }} @enderror
        </div>
        
        <div class="mt-3">
            <h5>Technologies : </h5>
        @foreach ($technologies as $technology)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="{{$technology->id}}" id="technology-{{$technology->id}}" name="technologies[]"  @if (in_array($technology->id, old('technologies', [])))
                    checked  
                @endif >
                <label class="form-check-label" for="flexCheckDefault">
                  {{$technology->name}}
                </label>
            </div>
            @endforeach
            <div class="invalid-feedback">
                @error('type_id') {{ $message }} @enderror
            </div>
        </div>
        

        <div class="mb-3 mt-3">
            <label for="url_image" class="form-label">Image_url</label>
            <input 
                type="url"
                class="form-control @error('url_image') is-invalid @enderror"
                id="url_image"
                name="url_image"
                value="{{ old('url_image') }}"
            >
            <div class="invalid-feedback">
                @error('url_image') {{ $message }} @enderror
            </div>
        </div>


        <div class="mb-3">
            <label for="repo" class="form-label">Repo name</label>
            <input
                type="text"
                class="form-control @error('repo') is-invalid @enderror"
                id="repo"
                name="repo"
                value="{{ old('repo') }}"
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
                value="{{ old('languages') }}"
            >
            <div class="invalid-feedback">
                @error('languages') {{ $message }} @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea
                class="form-control @error('description') is-invalid @enderror"
                id="description"
                rows="3"
                name="description">{{ old('description') }}</textarea>
            <div class="invalid-feedback">
                @error('description') {{ $message }} @enderror
            </div>
        </div>

        <button class="btn btn-primary">Save</button>
    </form>
@endsection