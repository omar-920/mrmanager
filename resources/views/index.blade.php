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
    

<form action="{{route('addgroup')}}" method="post">
    @csrf
  <div class="container d-flex">
    <label for="email"><b>Group Name</b></label>
    <input type="text" placeholder="Enter Group Name" name="group_name" id="email" required>

    <button type="submit" class="registerbtn w-25 ">Add</button>
  </div>
</form>
    <div class="tableRow">
        <div class="card mb-4">

            <div class="card mb-4">
                <div class="card-header">Extended DataTables</div>
                <div class="card-body">
                    <div class="datatable-container">
                        <table>
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
                                    <td>{{$counter}}</td>
                                    <td>{{$group->name}}</td>
                                    <td class="actions">
                                        
                                        <a class="btn btn-primary edit" href="{{ route('editgroup', $group->id) }}">Edit</a>
                                        
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$group->id}}">
                                            Delete
                                        </button>
                        
                                        <div class="modal fade" id="myModal{{$group->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this group?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <!-- Form to delete the group -->
                                                        <form action="{{ route('deletegroup', $group->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <a href="{{ url('/groups/' . $group->id) }}" class="btn btn-primary">Sessions</a>

                        
                                        <a class="btn btn-primary" href="{{ route('group.students', $group->id)}} ">Students</a>
                                    </td>
                                </tr>
                                @php
                                    $counter++;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                        
                            </div>
</div></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection