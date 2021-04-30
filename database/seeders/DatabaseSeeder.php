<?php

namespace Database\Seeders;

use Database\Factories\AdsFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Categories::factory()->count(10)->create();

        \App\Models\User::factory()
                        ->count(20)
                        ->hasAds(5, function (array $attributes, $user) {
                                return [
                                    'user_id' => $user->id,
                                ];
                            })
                        ->create();
    }
}
