<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collage extends Model
{
    use HasFactory,HasUuids;

    
    protected $fillable=['name','image','category_id'];




    public function users()
    {
        return $this->HasToMany(User::class);
    }
    public function categories()
    {
        return $this->belongsTo(Category::class);
    }
    public function specialization()
    {
        return $this->HasToMany(Spacialization::class);
    }
}
