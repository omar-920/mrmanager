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
        @foreach ($quizzes as $quiz)
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
                    @foreach ($quizzes as $quiz)
                        <div class="mt-2">
                            <li class="list-group-item bg-dark d-flex justify-content-between w-100">
                                <div class=" bg-dark d-flex justify-content-between w-100">
                                    <a href="{{ route('quizzes.showScores', $quiz->id) }}"
                                        class="text-decoration-none fs-4 text-bg-primary p-2 rounded-2">{{ $quiz->name }}</a>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#myModal{{ $quiz->id }}">
                                        Delete
                                    </button>

                                    <div class="modal fade" id="myModal{{ $quiz->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this quiz?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <form action="{{ route('quizzes.deleteQuiz', $quiz->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </div>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
