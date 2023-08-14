<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NationalAnswer extends Model
{
    use HasFactory ,HasUuids;
    protected $fillable=['answer','question_id','status'];

    public function questions()
    {
        return $this->belongsTo(NationalQuestion::class);
    }
}
