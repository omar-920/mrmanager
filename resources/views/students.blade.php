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
    

    <div class="tableRow">
        <div class="card mb-4">

            <div class="card mb-4">
                <div class="card-header">Add Student :-
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                        Add Student
                    </button>
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    {{-- MOdal Body --}}
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
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <!-- Form to add the student -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="datatable-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Group Name</th>
                                    <th>Phone</th>
                                    <th>Parent Phone</th>
                                    <th>Notes</th>
                                    <th>Withdraw Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr>
                                        <td>{{ $student->id }}</td>
                                        <td>{{ $student->name }}</td>
                                        <td>
                                            {{ $student->group ? $student->group->name : 'No Group' }}
                                        </td>
                                        <td>{{ $student->phone }}</td>
                                        <td>{{ $student->parent_phone }}</td>
                                        <td>{{ $student->note }}</td>
                                        <td>
                                        @if($student->status == 'unpaid')
                                            <a href="{{ route('payStudent', $student->id) }}" class="btn btn-success">Pay</a>
                                        @else
                                        <span>@if($student->status == 'paid' && $student->paid_at)
                                            ({{ \Carbon\Carbon::parse($student->paid_at)->format('Y-m-d') }})
                                        @elseif($student->status == 'paid' && !$student->paid_at)
                                            (Paid status is set, but no date available.)
                                        @endif
                                        </span>
                                    @endif
                                    </td>
                                        <td class="actions">
                                            
                                            <button type="button" class="btn btn-primary mx-2" data-toggle="modal" data-target="#myModal{{ $student->id }}">
                                                Edit
                                            </button>
                        
                                            <div class="modal fade" id="myModal{{ $student->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('updateStudent', $student->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="name">Name</label>
                                                                        <input type="text" class="form-control" name="name" value="{{ $student->name }}" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="group_id">Group</label>
                                                                        <select name="group_id" class="form-control" required>
                                                                            @foreach ($groups as $group)
                                                                                <option value="{{ $group->id }}" {{ $student->group_id == $group->id ? 'selected' : '' }}>
                                                                                    {{ $group->name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="phone">Phone</label>
                                                                        <input type="text" class="form-control" name="phone" value="{{ $student->phone }}" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="parent_phone">Parent Phone</label>
                                                                        <input type="text" class="form-control" name="parent_phone" value="{{ $student->parent_phone }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="parent_phone">Notes</label>
                                                                        <input type="text" class="form-control" name="note" value="{{ $student->note }}">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <!-- Form to delete the student -->
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($student->status == "paid")
                                                <a href="" class="btn btn-secondary disabled">paid</a>
                                            @endif
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal{{ $student->id }}delete">
                                                Delete
                                            </button>
                        
                                            <div class="modal fade" id="myModal{{ $student->id }}delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this student?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <!-- Form to delete the student -->
                                                            <form action="{{ route('student.delete', $student->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Delete</button>
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
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#resetPaymentsModal">
                        Reset All Payments
                    </button>
                <!-- Modal -->
                <div class="modal fade" id="resetPaymentsModal" tabindex="-1" role="dialog" aria-labelledby="resetPaymentsLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="resetPaymentsLabel">Confirm Reset</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to reset the payment statuses for all students? This action cannot be undone.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <!-- Form to submit the reset request -->
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
        </div>
    </div>
</div>


@endsection