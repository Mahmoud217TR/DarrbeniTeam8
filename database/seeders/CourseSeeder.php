<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::create([
            'uuid'=>Str::uuid(),

            'name' => 'مترجمات',
            
            'spacialization_id'=>'2'
           ]);
           Course::create([
            'uuid'=>Str::uuid(),

            'name' => 'داتا بيز',
            
            'spacialization_id'=>'2'
           ]); 
           Course::create([
            'uuid'=>Str::uuid(),

            'name' => 'أوتومات',
            
            'spacialization_id'=>'2'
           ]);
           Course::create([
            'uuid'=>Str::uuid(),

            'name' => 'الشبكات',
            
            'spacialization_id'=>'2'
           ]);
           Course::create([
            'uuid'=>Str::uuid(),

            'name' => 'الذكاء الاصطناعي',
            
            'spacialization_id'=>'2'
           ]);
           Course::create([
            'uuid'=>Str::uuid(),

            'name' => 'قواعد المعطيات',
            
            'spacialization_id'=>'2'
           ]);
           Course::create([
            'uuid'=>Str::uuid(),

            'name' => 'هندسة برمجيات',
            
            'spacialization_id'=>'2'
           ]);
           Course::create([
            'uuid'=>Str::uuid(),

            'name' => 'أمن',
            
            'spacialization_id'=>'2'
           ]);
           Course::create([
            'uuid'=>Str::uuid(),

            'name' => 'خوارزميات',
            
            'spacialization_id'=>'2'
           ]);
           Course::create([
            'uuid'=>Str::uuid(),

            'name' => 'الذكاء الاصطناعي',
            
            'spacialization_id'=>'1'
           ]);
           Course::create([
            'uuid'=>Str::uuid(),

            'name' => 'الشبكات',
            
            'spacialization_id'=>'1'
           ]);
           Course::create([
            'uuid'=>Str::uuid(),

            'name' => 'هندسة برمجيات',
            
            'spacialization_id'=>'1'
           ]);
           


           
    }
}
