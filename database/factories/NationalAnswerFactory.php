<?php

namespace Database\Factories;

use App\Models\NationalAnswer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NationalAnswer>
 */
class NationalAnswerFactory extends Factory
{
    protected $model = NationalAnswer::class;

    public function definition()
    {
        $nationQ = $this->faker->numberBetween(1, 100);

        return [
            'uuid' => Str::uuid(),
            'answer' => $this->faker->sentence,
            'status' => $this->faker->randomElement([1, 0, 2, 3]), // One in four chance of status being 1
            'national_question_id' => $nationQ
        ];

        
    }
}
