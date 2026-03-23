<?php

namespace Database\Factories;

use App\Enums\SubscriberStatus;
use App\Models\NewsletterSubscription;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<NewsletterSubscription>
 */
class NewsletterSubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => $this->faker->email(),
            'status' => SubscriberStatus::Subscribed,
            'subscribed_at' => now(),
        ];
    }
}
