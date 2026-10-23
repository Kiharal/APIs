<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Unsplash\HttpClient;
use Unsplash\Search;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        HttpClient::init([
            'applicationId' => config('services.unsplash.access'),
            'secret' => config('services.unsplash.secret'),
            'callbackUrl' => 'callback',
            'utmSource' => config('services.unsplash.app_name'),
        ]);

        $search = 'dog';
        $page = 1;
        $per_page = 1;
        $orientation = 'landscape';

        $payload = Search::photos($search, $page, $per_page, $orientation);
        $result = $payload->getResults();
        $image = $result[0]['urls']['small'];


        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'avatar' => $image,
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
