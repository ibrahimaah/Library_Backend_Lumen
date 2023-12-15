<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
    	return [
    	    'comment'=>$this->faker->sentence,
    	    'post_id'=> 2,
    	    'user_id'=> 1,
    	];
    }
}
