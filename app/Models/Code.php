<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['value', 'collage_id','user_id'];


    public function collages()
    {
        return $this->hasOne(Collage::class);
    }
    public function users()
    {
        return $this->belongsTo(Collage::class);
    }
}
