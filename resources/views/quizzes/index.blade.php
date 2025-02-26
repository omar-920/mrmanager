{{-- @extends('layouts.default')

@section('main')
<h2 class="text-center my-4">Quizzes</h2>
<div class="container">
    <div class="row mb-3">
        <div class="col text-center">
            <a href="{{ route('quizzes.create') }}" class="btn btn-primary">Add New Quiz</a>
        </div>
    </div>
    <ul class="list-group">
        @foreach($quizzes as $quiz)
            <li class="list-group-item">
                <a href="{{ route('quizzes.showScores', $quiz->id) }}" class="text-decoration-none">{{ $quiz->name }}</a>
            </li>
        @endforeach
    </ul>
</div>
@endsection --}}
@extends('layouts.default')

@section('main')
<div class="container-fluid" style="padding: 0; margin: 0;">
    <h2 class="text-center my-4">Quizzes</h2>
    <div class="row mb-3">
        <div class="col text-center">
            <a href="{{ route('quizzes.create') }}" class="btn btn-primary">Add New Quiz</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <ul class="list-group">
                @foreach($quizzes as $quiz)
                    <li class="list-group-item">
                        <a href="{{ route('quizzes.showScores', $quiz->id) }}" class="text-decoration-none">{{ $quiz->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection