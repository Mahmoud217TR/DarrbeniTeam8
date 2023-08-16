<?php

namespace Database\Seeders;

use App\Models\Code;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Code::create([
            'uuid'=>Str::uuid(),

            'value' =>  '123aa12',
            'collage_id'=>'1',
            'user_id'=>'1'
           
           ]);
           Code::create([
            'uuid'=>Str::uuid(),

            'value' =>  '1234aa12',
            'collage_id'=>'1',
            'user_id'=>'2'
           
           ]);
           Code::create([
            'uuid'=>Str::uuid(),

            'value' =>  '12345aa12',
            'collage_id'=>'2',
            'user_id'=>'3'
           
           ]);
           Code::create([
            'uuid'=>Str::uuid(),

            'value' =>  '123456aa12',
            'collage_id'=>'3',
            'user_id'=>'4'
           
           ]);
           Code::create([
            'uuid'=>Str::uuid(),

            'value' =>  '1234567aa12',
            'collage_id'=>'4',
            'user_id'=>'5'
           
           ]);
    }
}
