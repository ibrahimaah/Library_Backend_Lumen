<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'username' => $this->faker->unique()->regexify('[A-Za-z0-9]{10}'),
            'password' => '$2y$10$dvg0jvPus0O.DKeF/uAKXeIGou4Dc03xoLb.VKidWj6fffMYqsU3S'//123456
        ];
    }
}
