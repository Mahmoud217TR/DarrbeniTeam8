<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseAnswer extends Model
{
    use HasFactory;
    // ,HasUuids
    protected $fillable=['answer','uuid'];
    
    
    public function questions()
    {
        return $this->belongsToMany(CourseQuestion::class,'course_answer_questions');
    }
}
