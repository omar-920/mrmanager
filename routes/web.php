<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Models\Group;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function(){


//GROUPS>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>.

Route::get('/', function () {

    $groups = Group::where('user_id', Auth::user()->id)->get();
    
    return view('index', compact('groups')); 
})->name("index");



Route::get('/addgroup', function () {
    return view('addGroup');
})->name('addgroupPage');
Route::post('addgroup',[GroupController::class,'addGroup'])->name("addgroup");

Route::get('group/{id}/edit', [GroupController::class,'editgroup'])->name('editgroup');
Route::put('group/{id}', [GroupController::class,'updategroup'])->name('updategroup');


Route::delete('group/{groupid}', [GroupController::class,'destroy'])->name('deletegroup');

//STUDENTS>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>.


Route::get('groups/{id}/students',[StudentController::class,'showGroupStudents'])->name('group.students');

Route::get('/students', function () {
    $groups = Group::where('user_id', Auth::user()->id)->get();
    $students = Student::where('user_id', Auth::user()->id)->get();
    
    return view('students', ['groups' => $groups, 'students' => $students]);
})->name("groups");

Route::post('students', [StudentController::class, 'store'])->name('storeStudent');

Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('student.delete');

Route::get('/students/pay/{id}', [StudentController::class, 'payStudent'])->name('payStudent');



//Calc>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

Route::get('/groups/form', [GroupController::class, 'showGroupsForm'])->name('groups.form');

Route::post('/groups/calculate', [GroupController::class, 'calculateTotal'])->name('groups.calculate');
//Sessions>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
Route::post('/students/reset-payments', [StudentController::class, 'resetAllPayments'])->name('resetAllPayments');
Route::put('/students/{id}', [StudentController::class, 'update'])->name('updateStudent');

Route::get('/groups/{id}', [GroupController::class, 'showSessions']); 
Route::post('/groups/{id}/update', [GroupController::class, 'updateSessions']);
Route::post('/groups/{id}/reset', [GroupController::class, 'resetSessions'])->name('resetSessions');

Route::post('/logout',[UserController::class , 'logout'])->name("logout");

//Student profile######################333
Route::get('/students/{id}/profile', [StudentController::class, 'show'])->name('studentsProfile');

//Qiezzes
Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index');

Route::get('/quizzes/create', [QuizController::class, 'create'])->name('quizzes.create');
Route::post('/quizzes', [QuizController::class, 'store'])->name('quizzes.store');

Route::delete('/quizzes/{id}/delete',[QuizController::class, 'deleteQuiz'])->name('quizzes.deleteQuiz');

Route::get('/quizzes/{id}/scores', [QuizController::class, 'showScores'])->name('quizzes.showScores');
Route::post('/quizzes/{id}/scores', [QuizController::class, 'storeScores'])->name('quizzes.storeScores');

//Admin####################################################################

Route::middleware('Admin')->group(function(){

Route::get('/register', function () {
    return view('register');
})->name("registerPage");
Route::post('/register',[UserController::class , 'store'])->name("register");
Route::get('/teachers',[UserController::class, 'getTeachers'])->name('getTeachers');
Route::put('/teacher/{id}/edit',[UserController::class,'update'])->name('update.teacher');
Route::delete('/teacher/{id}/delete',[UserController::class,'destroy'])->name('destroy.teacher');
});
});


//Authentication...................................................................


Route::get('/login', function () {
    return view('login');
})->middleware('guest')->name("loginPage");
Route::post('/login',[UserController::class , 'login'])->name("login");

