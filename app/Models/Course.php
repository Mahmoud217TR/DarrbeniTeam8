<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory, HasUuids;
    protected $fillable=['name','image','spacialization_id'];




    public function specializations()
    {
        return $this->HasToMany(Spacialization::class);
    }
}
