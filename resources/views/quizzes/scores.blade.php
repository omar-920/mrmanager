@extends('layouts.default')

@section('main')
    <h2>Quiz Name : {{ $quiz->name }}</h2>

    <form action="{{ route('quizzes.storeScores', $quiz->id) }}" method="POST">
        @csrf
        <table>
            <tr>
                <th>Name </th>
                <th>Score</th>
                <th>Total Score</th>
            </tr>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>
                        <input type="number" name="scores[{{ $student->id }}]"
                            value="{{ $quiz->quizScores->where('student_id', $student->id)->first()->score ?? '' }}">
                    </td>
                    <td>
                        <label for="total_score">Total Score</label>
                        <input type="number" id="total_score" name="total_score" required min="1" value="100">
                    </td>
                </tr>
            @endforeach
        </table>
        <button type="submit">Save</button>
    </form>
@endsection
