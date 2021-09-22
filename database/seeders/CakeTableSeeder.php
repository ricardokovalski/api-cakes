<?php

namespace Database\Seeders;

use App\Models\Cake;
use Illuminate\Database\Seeder;

class CakeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cakes = [
            ['Bolo de Chocolate', 3.45, 95.00, 10],
            ['Bolo de Morango', 2.75, 45.90, 10],
            ['Floresta Negra', 3.50, 120.50, 10],
        ];

        foreach ($cakes as $cake) {
            list($name, $weight, $value, $quantity) = $cake;
            Cake::create([
                'name' => $name,
                'weight' => $weight,
                'value' => $value,
                'quantity' => $quantity,
            ]);
        }
    }
}
