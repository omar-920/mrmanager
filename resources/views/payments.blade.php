
@extends('layouts.default')
@section('main')
<div class="container">
    <h2>Group Payment Summary</h2>
    <form action="{{ route('groups.calculate') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="course_fee">Course Fee ($):</label>
            <input type="number" name="course_fee" id="course_fee" class="form-control" required>
        </div>
        <div class="form-group mt-3">
            <label for="discount">Discount ($):</label>
            <input type="number" name="discount" id="discount" class="form-control" value="0">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Calculate</button>
    </form>

    @if(isset($courseFee))
    <h3 class="mt-5">Course Fee: ${{ $courseFee }}</h3>
    <h4>Discount: ${{ $discount }}</h4>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Group Name</th>
                <th>Paid Students Count</th>
                <th>Total Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($groups as $group)
            <tr>
                <td>{{ $group->name }}</td>
                <td>{{ $group->students->where('status', 'paid')->count() }}</td>
                <td>${{ isset($group->totalAmount) ? $group->totalAmount : 0 }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Total Amount from All Groups: ${{ $totalAmount }}</h4>
    <h4>Final Total (after Discount): ${{ $finalAmount }}</h4>
    
    @endif
</div>
@endsection
