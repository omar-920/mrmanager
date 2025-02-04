<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    
    public function addGroup(Request $request)
    {
        Group::create([
            'name' => $request->group_name,
            'user_id' => Auth::user()->id,
        ]);
        return redirect()->route('index');
    }

    public function editgroup(Request $request , $id)
    {
        $group = Group::findOrFail($id);
        return view('editGroupPage', compact('group'));
    }
    public function updategroup(Request $request, $id)
    {
        $group = Group::findOrFail($id);
        $group->name = $request->name;  
        $group->save();
    
        return redirect()->route('index');
    }
    public function destroy($groupid)
    {
        $groups = Group::findOrFail($groupid);
        $groups->delete();

        session()->flash('success', 'You have successfully Delete Group !');
        return redirect()->route('index');

    }

    
    public function showGroupsForm()
    {
        $groups = Group::where('user_id', Auth::user()->id)->get();
        
        return view('payments', compact('groups'));
    }

    public function calculateTotal(Request $request)
    {
        $request->validate([
            'course_fee' => 'required|numeric|min:1', 
            'discount' => 'nullable|numeric|min:0', 
        ]);

        $courseFee = $request->input('course_fee');
        
        $discount = $request->input('discount', 0);
        
        $groups = Group::where('user_id', Auth::user()->id)->get();

        $totalAmount = 0;

        foreach ($groups as $group) {
            $paidStudentsCount = Student::where('group_id', $group->id)
                                        ->where('status', 'paid')
                                        ->count();

            $groupTotal = $paidStudentsCount * $courseFee;
            $group->totalAmount = $groupTotal;
            $totalAmount += $groupTotal;
        }

        $finalAmount = $totalAmount - $discount;

        return view('payments', compact('groups', 'totalAmount', 'finalAmount', 'courseFee', 'discount'));
    }


    public function showSessions($id)
    {
        $group = Group::findOrFail($id);
        $completedSessionsCount = $group->completed_sessions; 
        return view('checkpage', compact('group'),compact('completedSessionsCount'));
    }

    public function updateSessions(Request $request, $id)
    {
        $group = Group::findOrFail($id); 
    
    $selectedSessions = $request->input('sessions'); 
    
    $group->update([
        'completed_sessions' => count($selectedSessions),
    ]);
        return redirect()->back()->with('success', 'Updated successfully!');
    }

    public function resetSessions($id)
    {
        $group = Group::findOrFail($id);
        
        $group->update(['completed_sessions' => 0]);
        return redirect()->back()->with('success', 'reseted!');

    }


}
