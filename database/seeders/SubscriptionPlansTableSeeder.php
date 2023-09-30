<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SubscriptionPlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {

            $randomDateTime = date('Y-m-d H:i:s', strtotime('-30 days', strtotime(now())) + mt_rand(0, 30 * 24 * 3600));
            $features = [];
            for ($i = 0; $i < mt_rand(2, 5); $i++) { // Generate 2 to 5 features
                $features[] = $faker->sentence;
            }

            DB::table('subscription_packages')->insert([
                'name' => $faker->unique()->sentence(2),
                'slug' => $faker->unique()->slug,
                'amount' => $faker->randomFloat(2, 10, 100),
                'features' =>  implode(',',$features),
                'type' => $faker->randomElement(['monthly', 'yearly']),
                'status' => $faker->randomElement(['active', 'inactive']),
                'created_by' => $faker->numberBetween(1, 5), // Assuming user IDs 1 to 5
                'created_at' => $randomDateTime,
                'updated_at' => now(),
            ]);
        }
    }
}