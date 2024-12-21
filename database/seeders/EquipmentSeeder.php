<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Equipment;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run()
{
    Equipment::create(['name' => 'Laptop', 'price' => 50]);
    Equipment::create(['name' => 'Proiector', 'price' => 100]);
}
}
