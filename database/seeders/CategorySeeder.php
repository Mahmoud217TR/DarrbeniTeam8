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
        $imageFilePath1 = 'D:/svg/ARCH.svg';
        
        // Store the image in the storage folder
        $imagePath1 = Storage::putFile('public/Category', $imageFilePath1);

        Category::create([
            'uuid'=>Str::uuid(),
            'name' => 'الكليات الهندسية',
            'image'=>$imagePath1,
           ]);

           $imageFilePath2 = 'D:/svg/DR.svg';
        
           // Store the image in the storage folder
           $imagePath2 = Storage::putFile('public/Category', $imageFilePath2);
           Category::create([
            'uuid'=>Str::uuid(),

            'name' => 'الكليات الطبية ',
            'image'=>$imagePath2,
           ]);
    }
}
