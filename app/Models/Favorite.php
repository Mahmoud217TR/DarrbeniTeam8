<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Favorite extends Model
{
    use HasFactory;
    // ,HasUuids
    protected $fillable=['user_id','uuid','favoriteble_type','favoriteble_id'];
    
    public function favoriteble(): MorphTo
    {
        return $this->morphTo();
    }
}
