<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
  
    
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'group_id' => 'exists:groups,id',
            'phone' => 'required|string|max:15',
            'parent_phone' => 'nullable|string|max:15',
            'note' => 'nullable|string',
        ]);
    
        $student = Student::findOrFail($id);
        $student->update($validated);
    
        return redirect()->back()->with('success', 'Student updated successfully.');
    }
    
public function showGroupStudents($id)
{
    $groups = Group::find($id);

    if (!$groups) {
        return redirect()->back()->withErrors('Group not found');
    }

    $students = Student::where('group_id', $id)->get();

    return view('groupstudents', compact('students', 'groups'));
}


public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:15',
        'parent_phone' => 'nullable|string|max:15',
        'note' => 'nullable|string',
        'group_id' => 'required|exists:groups,id',
    ]);

    $validated['user_id'] = Auth::user()->id;

    $student = Student::create($validated);

    return redirect()->route('groups')->with('success', 'Student added successfully!');
}

public function destroy($id)
{
    $student = Student::findOrFail($id);
    $student->delete();

    return redirect()->route('groups')->with('success', 'Student deleted successfully!');
}
public function show($id)
{
    $student = Student::with(['quizScores.quiz'])->findOrFail($id);

    return view('studentProfile', compact('student'));
}
public function payStudent($id)
{
    $student = Student::findOrFail($id);
    $student->status = 'paid';
    $student->paid_at = Carbon::now();  
    $student->save();  

    return redirect()->back()->with('success', 'Student payment has been successfully recorded!');
}
public function resetAllPayments()
{
    Student::where('user_id', Auth::id())->update([
        'status' => 'unpaid',
        'paid_at' => null,
    ]);

    return redirect()->back()->with('success', 'All payment statuses have been reset successfully.');
}

}
