<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class NationalQuestion extends Model
{
    use HasFactory;
    // ,HasUuids
    protected $fillable=['question','date','spacialization_id','uuid'];

    public function specialization()
    {
        return $this->belongsTo(Spacialization::class);
    }
  
    public function answers()
    {
        return $this->hasMany(NationalAnswer::class);
    }
    public function reference()
    {
        return $this->morphOne(Reference::class, 'referenceable');
    }
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favoritable');
    }
}
