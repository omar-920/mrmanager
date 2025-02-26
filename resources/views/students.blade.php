@extends('layouts.default')

@section('main')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Students</h1>
        <ol class="breadcrumb mb-4">
            @if (session('success'))
                <div class="alert alert-success m-5" id="success-message">
                    {{ session('success') }}
                </div>
            @endif
        </ol>
    </div>

    <div class="container">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Add Student</span>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                    Add Student
                </button>
            </div>

            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('storeStudent') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Student Name</label>
                                    <input type="text" name="name" id="name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" id="phone" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="parent_phone">Parent Phone</label>
                                    <input type="text" name="parent_phone" id="parent_phone" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="note">Notes</label>
                                    <input type="text" name="note" id="note" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="group_id">Group</label>
                                    <select name="group_id" id="group_id" class="form-control" required>
                                        @foreach ($groups as $group)
                                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Add Student</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Group Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{ $student->id }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->group ? $student->group->name : 'No Group' }}</td>
                                    
                                    <td class="actions">
                                        <div class="d-flex flex-column flex-md-row gap-2">
                                            <a href="{{ route('studentsProfile', $student->id) }}" class="btn btn-secondary">Profile</a>

                                        <button type="button" class="btn btn-primary btn-sm mx-1" data-toggle="modal"
                                            data-target="#myModal{{ $student->id }}">
                                            Edit
                                        </button>

                                        <div class="modal fade" id="myModal{{ $student->id }}" tabindex="-1"
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
                                                        <form action="{{ route('updateStudent', $student->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="name">Name</label>
                                                                <input type="text" class="form-control" name="name"
                                                                    value="{{ $student->name }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="group_id">Group</label>
                                                                <select name="group_id" class="form-control" required>
                                                                    @foreach ($groups as $group)
                                                                        <option value="{{ $group->id }}"
                                                                            {{ $student->group_id == $group->id ? 'selected' : '' }}>
                                                                            {{ $group->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="phone">Phone</label>
                                                                <input type="text" class="form-control" name="phone"
                                                                    value="{{ $student->phone }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="parent_phone">Parent Phone</label>
                                                                <input type="text" class="form-control"
                                                                    name="parent_phone"
                                                                    value="{{ $student->parent_phone }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="note">Notes</label>
                                                                <input type="text" class="form-control" name="note"
                                                                    value="{{ $student->note }}">
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
                                            data-target="#myModal{{ $student->id }}delete">
                                            Delete
                                        </button>

                                        <div class="modal fade" id="myModal{{ $student->id }}delete" tabindex="-1"
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
                                                            Are you sure you want to delete this student?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <form action="{{ route('student.delete', $student->id) }}"
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
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#resetPaymentsModal">
                    Reset All Payments
                </button>

                <!-- Reset Payments Modal -->
                <div class="modal fade" id="resetPaymentsModal" tabindex="-1" role="dialog"
                    aria-labelledby="resetPaymentsLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="resetPaymentsLabel">Confirm Reset</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to reset the payment statuses for all students? This action cannot be
                                undone.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <form action="{{ route('resetAllPayments') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Confirm Reset</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
