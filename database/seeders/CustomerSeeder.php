<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $total = Customer::count();
        if ($total > 0) {
            return;
        }
        
        $country = Country::first();
        if (!$country) {
            return;
        }

        Customer::factory()
            ->count(12)
            ->create([
                'country_id' => $country->id,
            ]);
    }
}
