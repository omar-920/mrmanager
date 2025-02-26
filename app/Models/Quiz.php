<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = ['st_id', 'name', 'score', 'total_score'];
    protected $table = 'quizzes';
    public function quizScores()
    {
        return $this->hasMany(QuizScore::class);
    }
}
