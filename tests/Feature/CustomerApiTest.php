<?php

namespace Tests\Feature;

use App\Domains\Customer\Eloquents\Customer as CustomerEloquent;
use App\Domains\User\Eloquents\User as UserEloquent;
use App\Values\EmailAddress;
use App\Values\Http\Method as HttpMethod;
use App\Values\Http\StatusCode as HttpStatusCode;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_create_customer(): void
    {
        $data = [
            "user" => [
                "name" => fake()->name(),
                "email" => fake()->unique()->safeEmail(),
                "password" => [
                    "value" => "Thomas123!",
                    "isEncrypted" => false
                ],
            ],
        ];

        $body = [
            "status" => "ok",
            "data" => [
                "customer" => [
                    "user" => [
                        "name" => $data['user']['name'],
                        "email" => (new EmailAddress($data['user']['email']))->jsonSerialize(),
                    ]
                ]
            ]
        ];

        $this->json(HttpMethod::POST, route('api.jwt.register'), $data)
            ->assertStatus(HttpStatusCode::HTTP_CREATED)
            ->assertJson($body);
    }

    public function test_can_login(): void
    {
        /** @var UserEloquent $user */
        $user = UserEloquent::factory()->make();

        /** @var CustomerEloquent $customer */
        $customer = CustomerEloquent::factory()
            ->state(function (array $attributes) use ($user) {
                return ['user_id' => $user->id];
            })
            ->make();

        $user->save();
        $customer->save();

        $data = [
            "user" => [
                "email" => (string)$user->email,
                "password" => [
                    "value" => env('TEST_USER_PASSWORD'),
                    "isEncrypted" => false
                ]
            ]
        ];

        $response = $this->json(HttpMethod::POST, route('api.jwt.login'), $data)
            ->assertStatus(HttpStatusCode::HTTP_OK);
    }
}
