<?php

namespace Database\Factories;

use App\Models\Rating;
use Illuminate\Database\Eloquent\Factories\Factory;

class RatingFactory extends Factory
{
    protected $model = Rating::class;

    public function definition(): array
    {
    	return [
    	    'rating' => 5,
            'user_id' => 7,
            'book_id'=>101
    	];
    }
}
