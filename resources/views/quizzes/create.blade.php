@extends('layouts.default')
@section('main')
<h2>Add New Quiz</h2>

    @if (session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <form action="{{ route('quizzes.store') }}" method="POST">
        @csrf
        <label for="name">Quiz Name</label>
        <input type="text" id="name" name="name" required>

        <label for="total_score">Total Score:</label>
        <input type="number" id="total_score" name="total_score" required min="1" value="100">

        <button type="submit">Add</button>
    </form>
    

    <br>
    <a href="{{ route('quizzes.index') }}">Back to Quizzes Page</a>
@endsection