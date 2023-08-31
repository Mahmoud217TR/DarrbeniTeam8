<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory;
    use SoftDeletes;
    // ,HasUuids
    protected $fillable=['name','spacialization_id','uuid'];




    public function spacialization()
    {
        return $this->belongsTo(Spacialization::class);
    }

    public function nationalquestions()
    {
        return $this->hasMany(NationalQuestion::class);
    }
  
    
    public function questions()
    {
        return $this->HasMany(CourseOuestion::class);
    }
}
