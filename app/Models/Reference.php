<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Reference extends Model
{
    use HasFactory;
    protected $fillable=['refernce'];

    public function referenceable(): MorphTo
    {
        return $this->morphTo();
    }

}
