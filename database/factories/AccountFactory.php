<?php

namespace Database\Factories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountFactory extends Factory
{
    protected $model = Account::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'balance' => $this->faker->numberBetween(100, 1000),
        ];
    }
}
