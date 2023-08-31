<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       

        Category::create([
            'uuid'=>Str::uuid(),
            'name' => 'الكليات الهندسية',
           
           ]);

          
           Category::create([
            'uuid'=>Str::uuid(),

            'name' => 'الكليات الطبية ',
            
           ]);
    }
}
