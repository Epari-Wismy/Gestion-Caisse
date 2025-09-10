<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Customer;
use App\Models\Account;
use Faker\Factory as Faker;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $plans = [25, 50, 100, 250, 500, 1000, 2500, 5000];

        for ($i = 1; $i <= 6; $i++) {

            $customer = Customer::create([
                'id_customer' => sprintf('%04d-%04d', rand(1000, 9999), rand(1000, 9999)),
                'nom' => $faker->lastName,
                'prenom' => $faker->firstName,
                'adresse' => $faker->address,
                'telephone' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'is_verified_mail' => $faker->boolean(80),
                'activite' => $faker->company,
                'image' => null,
                'etat' => $faker->randomElement(['actif', 'inactif', 'bloquer'])
            ]);

            Account::create([
                'id_account' => sprintf('%04d-%04d', rand(1000, 9999), rand(1000, 9999)),
                'id_customer' => $customer->id,
                'montant_plan' => $plans[array_rand($plans)],
                'nb_jours' => 30,
                'solde' => $faker->numberBetween(0, 1000),
                'nb_jours_rester' => rand(1,30),
                'etat' => $faker->randomElement(['actif', 'inactif', 'bloquer'])
            ]);
        }
    }
}
