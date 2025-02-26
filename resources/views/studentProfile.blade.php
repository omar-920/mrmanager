@extends('layouts.default')

@section('main')
    <h2>Profile : {{ $student->name }}</h2>

    <h3>📞 Student Information</h3>
    <ul>
        <li>📱Phone: {{ $student->phone }}</li>
        <li>👨‍👩‍👦 Parent Phone: {{ $student->parent_phone }}</li>
        <li>💰 Payments Status: <span class="text-danger">
            @if ($student->status == 'unpaid')
                                            <a href="{{ route('payStudent', $student->id) }}"
                                                class="btn btn-success btn-sm">Pay</a>
                                        @else
                                            <span>
                                                @if ($student->status == 'paid' && $student->paid_at)
                                                    ({{ \Carbon\Carbon::parse($student->paid_at)->format('Y-m-d') }})
                                                @elseif($student->status == 'paid' && !$student->paid_at)
                                                    (Paid status is set, but no date available.)
                                                @endif
                                            </span>
                                        @endif
        </span></li>
    </ul>

    <h3>📊 Scores</h3>
    <table border="1">
        <tr>
            <th>Quiez</th>
            <th>Score</th>
            <th>Total Score</th>
        </tr>
        @foreach($student->quizScores as $score)
            <tr>
                <td>{{ $score->quiz->name }}</td>
                <td>{{ $score->score }}</td>
                <td>{{ $score->quiz->total_score }}</td>
            </tr>
        @endforeach
    </table>

   
    <a href="{{ route('index') }}">🔙 Back to Main page</a>
@endsection
