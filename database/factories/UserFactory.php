<?php

namespace Database\Factories;

use App\Domains\User\Eloquents\User as UserEloquent;
use App\Values\EmailAddress;
use App\Values\Password;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model|TModel>
     */
    protected $model = UserEloquent::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => guid(),
            'name' => $this->faker->name(),
            'email' => new EmailAddress($this->faker->unique()->safeEmail()),
            'email_verified_at' => Carbon::now(),
            'password' => new Password(bcrypt(env('TEST_USER_PASSWORD')), true),
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now(),
        ];
    }
}
