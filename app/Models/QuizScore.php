<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizScore extends Model
{
    protected $fillable = ['quiz_id', 'student_id', 'score'];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class,'quiz_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
