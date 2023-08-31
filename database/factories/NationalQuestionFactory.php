<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\NationalQuestion;
use App\Models\Spacialization;
use App\Models\Specialization;
use Carbon\Carbon;
use Database\Seeders\SpecializationSeeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

class NationalQuestionFactory extends Factory
{
    protected $model = NationalQuestion::class;

    public function definition()
    {
        $this->faker->locale('ar_SA'); // Set locale to Arabic

        $specialization = Spacialization::inRandomOrder()->first();
        $course = Course::inRandomOrder()->first();

        // Define specific dates
        $dates = [
            'Nov/2020' => Carbon::create(2020, 11, 1),
            'Jun/2021' => Carbon::create(2021, 6, 1),
            'Nov/2022' => Carbon::create(2022, 11, 1),
        ];

        $selectedDate = $this->faker->randomElement($dates);

        return [
            'uuid' => Str::uuid(),
            'question' => $this->faker->realText(), // Generates a random Arabic sentence
            'date' => $selectedDate,
            'spacialization_id' => $specialization->id,
            'course_id' => $course->id
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (NationalQuestion $question) {
            $question->reference()->create([
                'uuid' => Str::uuid(),
                'reference' => $this->faker->word,
            ]);
        });
    }
}