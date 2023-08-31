<?php

namespace Database\Seeders;

use App\Models\Spacialization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Spacialization::create([
            'uuid'=>Str::uuid(),

            'name' => ' ماستر',
            
            'collage_id'=>'5'
           ]);
           Spacialization::create([
            'uuid'=>Str::uuid(),

            'name' => 'تخرج ',
            
            'collage_id'=>'5'
           ]);
           
    }
}
