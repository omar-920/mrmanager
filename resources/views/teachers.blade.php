@extends('layouts.default')

@section('main')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            @if (session('success'))
                <div class="alert alert-success m-5" id="success-message">
                    {{ session('success') }}
                </div>
            @endif
        </ol>
    </div>

    <div class="container">
        <div class="table-responsive">
            <div class="card mb-4">
                <div class="card-header">Extended DataTables</div>
                <div class="card-body">
                    @if (Auth::user()->role === 'admin')
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($teachers as $teacher)
                                    <tr>
                                        <td>{{ $teacher->id }}</td>
                                        <td>{{ $teacher->name }}</td>
                                        <td>{{ $teacher->role }}</td>
                                        <td>{{ $teacher->email }}</td>
                                        <td class="actions d-flex flex-column flex-md-row gap-2">
                                            <button type="button" class="btn btn-primary btn-sm mx-1" data-toggle="modal"
                                                data-target="#myModal{{ $teacher->id }}">
                                                Edit
                                            </button>
    
                                            <div class="modal fade" id="myModal{{ $teacher->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('update.teacher', $teacher->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group">
                                                                    <label for="name">Name</label>
                                                                    <input type="text" class="form-control" name="name"
                                                                        value="{{ $teacher->name }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="email">emali</label>
                                                                    <input type="text" class="form-control" name="email"
                                                                        value="{{ $teacher->email }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="password">password</label>
                                                                    <input type="text" class="form-control"
                                                                        name="password"
                                                                        value="">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save
                                                                        Changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <button type="button" class="btn btn-danger btn-sm mx-1" data-toggle="modal"
                                                data-target="#myModal{{ $teacher->id }}delete">
                                                Delete
                                            </button>
    
                                            <div class="modal fade" id="myModal{{ $teacher->id }}delete" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Confirm Delete
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to delete this User?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <form action="{{ route('destroy.teacher', $teacher->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
