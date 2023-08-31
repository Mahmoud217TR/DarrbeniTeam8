<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collage extends Model
{
    use HasFactory;
// ,HasUuids
use SoftDeletes;
    
    protected $fillable=['name','image','category_id','uuid'];




    public function users()
    {
        return $this->HasToMany(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function spacializations()
    {
        return $this->HasMany(Spacialization::class);
    }
}
