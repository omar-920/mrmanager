
@extends('layouts.default')

@section('main')
<div class="container">
    <form action="{{ route('updategroup', $group->id) }}" method="post" class="mt-4">
        @csrf
        @method("PUT")
        <div class="row align-items-center">
            <div class="col-md-8">
                <label for="name"><b>Name</b></label>
                <input type="text" placeholder="Enter Group Name" name="name" id="name" class="form-control" value="{{ $group->name }}" required>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary w-100">Edit</button>
            </div>
        </div>
    </form>
</div>
@endsection