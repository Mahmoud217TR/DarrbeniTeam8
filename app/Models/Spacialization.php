<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spacialization extends Model
{
    use HasFactory ;
    use SoftDeletes;
    // ,HasUuids
    protected $fillable=['name','collage_id','uuid'];


    public function collage()
    {
        return $this->belongsTo(Collage::class);
    }
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
    public function nationalQuestions()
    {
        return $this->hasMany(NationalQuestion::class);
    }
}
