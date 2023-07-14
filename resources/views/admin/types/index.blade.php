@extends('admin.layouts.base')
@section('contents')
<h1 class="py-3">Types:</h1>



<table class="table table-dark">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Actions:</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($types as $type)
            <tr>
                <th scope="row">{{ $type->id }}</th>
                <td>{{ $type->name }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ route('admin.types.show', ['type' => $type]) }}">View</a>
                    <button 
                        type="button" 
                        class="btn btn-danger js-delete" 
                        data-bs-toggle="modal" 
                        data-bs-target="#deleteModal" 
                        data-id="{{ $type->id }}">
                        Delete
                    </button>
                </td>
                
            </tr>
        @endforeach
    </tbody>
</table>



<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="deleteModalLabel">Action confirmation</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <div class="modal-body">
          Do you want to move this type to trash?
        </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form
                        action=""
                        data-template="{{ route('admin.types.destroy', ['type' => '*****']) }}"
                        method="post"
                        class="d-inline-block"
                        id="confirm-delete"
                    >
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger">Trash</button>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection
