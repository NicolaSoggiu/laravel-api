@extends('admin.layouts.base')

@section('contents')

<h1>Project : </h1>

@if (session('delete_success'))
        @php $project = session('delete_success') @endphp
        <div class="alert alert-danger">
            The project "{{ $project->title }}" was deleted
        </div>
    @endif

<table class="table table-dark">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Image</th>
            <th scope="col">Languages</th>
            <th scope="col">Type</th>
            <th scope="col">Technologies</th>
            <th scope="col">Description</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($projects as $project)
            <tr>
                <th scope="row">{{ $project->id }}</th>
                <td>{{ $project->title }}</td>
                <td>{{ $project->url_image }}</td>
                <td>{{ $project->languages }}</td>
                <td><a href="{{ route("admin.types.show", ["type" => $project->type]) }}">{{ $project->type->name }}</a></td>

                <td>{{ implode(', ', $project->technologies->pluck('name')->all()) }}</td>
                <td>{{ $project->description }}</td>
                <td>
                    <div class="d-flex">
                        <a class="btn btn-primary" href="{{ route('admin.projects.show', ['project' => $project]) }}">View</a>
                        <a class="btn btn-warning" href="{{ route('admin.projects.edit', ['project' => $project]) }}">Edit</a>
                    <button type="button" class="btn btn-danger js-delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $project->slug }}">
                        Delete
                      </button>
                    </div>
            </td>
        </tr>
    @endforeach

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Delete confirmation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            <form
                        action=""
                        data-template="{{ route('admin.projects.destroy', ['project' => '*****']) }}"
                        method="post"
                        class="d-inline-block"
                        id="confirm-delete"
                    >
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </tbody>
</table>

<a class="btn btn-primary" href="{{ route("admin.projects.create") }}">Create new post</a>


@endsection