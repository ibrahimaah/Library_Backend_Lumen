<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
    	return [
    	    'review' => $this->faker->sentence,
            'user_id' => 7,
            'book_id'=>101
    	];
    }
}
