<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;

use App\Models\Machine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MachineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Machine::insert([
            [
                "serNum" => "H24SS011",
                "name" => "The Barista Pro",
                "color" => "BSS",
                "price" => 13999000,
                "yom" => Carbon::create('2024', '05', '11')
            ]
        ]);
    }
}
