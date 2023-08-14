<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class NationalQuestion extends Model
{
    use HasFactory,HasUuids;
    protected $fillable=['question','date','spacialization_id'];

    public function answers()
    {
        return $this->hasToMany(NationalAnswer::class);
    }
    public function references(): MorphMany
    {
        return $this->morphMany(Reference::class, 'referenceable');
    }
    public function favorites(): MorphMany
    {
        return $this->morphMany(Favorite::class, 'favoriteble');
    }
}
