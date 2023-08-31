<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Complaints extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['name','complaints','user_id','uuid'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
