<?php

namespace Database\Seeders;

use App\Models\Collage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CollageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $imageFilePath2 = 'D:/svg/DR.svg';
        
        // Store the image in the storage folder
        $imagePath2 = Storage::putFile('public/Collage', $imageFilePath2);
        Collage::create([
         'uuid'=>Str::uuid(),

         'name' => 'طب بشري',
         'image'=>$imagePath2,
         'category_id'=>'2'
        ]);

        $imageFilePath3 = 'D:/svg/dentist.svg';
     
        // Store the image in the storage folder
        $imagePath3 = Storage::putFile('public/Collage', $imageFilePath3);
        Collage::create([
         'uuid'=>Str::uuid(),

         'name' => 'طب أسنان',
         'image'=>$imagePath3,
         'category_id'=>'2'
        ]);

        $imageFilePath4 = 'D:/svg/pharmacy.svg';
     
        // Store the image in the storage folder
        $imagePath4 = Storage::putFile('public/Collage', $imageFilePath4);
        Collage::create([
         'uuid'=>Str::uuid(),

         'name' => 'صيدلة',
         'image'=>$imagePath4,
         'category_id'=>'2'
        ]);

        $imageFilePath5 = 'D:/svg/nurs.svg';
     
        // Store the image in the storage folder
        $imagePath5 = Storage::putFile('public/Collage', $imageFilePath5);
         Collage::create([
         'uuid'=>Str::uuid(),

         'name' => 'تمريض',
         'image'=>$imagePath5,
         'category_id'=>'2'
        ]);
        
        $imageFilePath = 'D:\svg\It.svg';
        
        // Store the image in the storage folder
        $imagePath = Storage::putFile('public/Collage', $imageFilePath);

       
        Collage::create([
            'uuid'=>Str::uuid(),

            'name' => 'هندسة معلوماتية',

        'image'=>$imagePath,
            'category_id'=>'1'
           ]);

           $imageFilePath1 = 'D:/svg/ARCH.svg';
        
        // Store the image in the storage folder
        $imagePath1 = Storage::putFile('public/Collage', $imageFilePath1);

           Collage::create([
            'uuid'=>Str::uuid(),

            'name' => 'هندسة معمارية',
            'image'=>$imagePath1,
            'category_id'=>'1'
           ]);
          

          

    }
}
