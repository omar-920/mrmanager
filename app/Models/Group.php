<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $guarded = [''];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
