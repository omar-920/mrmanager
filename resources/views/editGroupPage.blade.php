@extends('layouts.default')
@section('main')

<form action="{{route('updategroup',$group->id)}}" method="post">
  @csrf
<div class="container d-flex">
  @method("PUT")
  <label for="email"><b>Name</b></label>
  <input type="text" placeholder="Enter Group Name" name="name" id="email" required>

  <button type="submit" class="registerbtn w-25 ">Edit</button>
</div>
</form>

@endsection