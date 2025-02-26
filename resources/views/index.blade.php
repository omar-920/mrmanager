@extends('layouts.default')

@section('main')
    <div class="container-fluid px-4">
        @if (Auth::user()->role === 'admin')
            <div class="welcome-container">
                <h1 class="mb-4">Welcome, {{ Auth::user()->name }}!</h1>
                <p class="mb-4">Feel Free to Manage MR Manager &#128522; </p>
                <a href="{{url('/teachers')}}" class="btn btn-primary">Go to Dashboard</a>
            </div>
        @else
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
        <form action="{{ route('addgroup') }}" method="post" class="mb-4">
            @csrf
            <div class="row align-items-center">
                <div class="col-md-8">
                    <label for="group_name"><b>Group Name</b></label>
                    <input type="text" placeholder="Enter Group Name" name="group_name" id="group_name"
                        class="form-control" required>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100">Add</button>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <div class="card mb-4">
                <div class="card-header">Extended DataTables</div>
                <div class="card-body">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $counter = 1;
                            @endphp
                            @foreach ($groups as $group)
                                <tr>
                                    <td>{{ $counter }}</td>
                                    <td>{{ $group->name }}</td>
                                    <td class="actions">
                                        <div class="d-flex flex-column flex-md-row gap-2">
                                                <a class="btn btn-primary btn-sm"
                                                    href="{{ route('editgroup', $group->id) }}">Edit</a>
        
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#myModal{{ $group->id }}">
                                                    Delete
                                                </button>
        
                                                <div class="modal fade" id="myModal{{ $group->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                Are you sure you want to delete this group?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <form action="{{ route('deletegroup', $group->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
        
                                                <a href="{{ url('/groups/' . $group->id) }}"
                                                    class="btn btn-primary btn-sm">Sessions</a>
                                                <a class="btn btn-primary btn-sm"
                                                    href="{{ route('group.students', $group->id) }}">Students</a>
                                            
                                        </div>
                                    </td>
                                </tr>
                                @php
                                    $counter++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
