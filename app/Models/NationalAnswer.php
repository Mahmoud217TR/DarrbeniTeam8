<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NationalAnswer extends Model
{
    use HasFactory ;
    // ,HasUuids
    protected $fillable=['answer','national_question_id','status','uuid'];

    public function question()
    {
        return $this->belongsTo(NationalQuestion::class);
    }
}
