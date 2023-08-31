<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseAnswerQuestion extends Model
{
    use HasFactory;
    // ,HasUuids
    protected $fillable=['course_answer_id','course_question_id','status','uuid'];
    
    
}
