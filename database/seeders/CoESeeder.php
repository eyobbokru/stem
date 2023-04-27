<?php

namespace Database\Seeders;

use App\Models\CoE;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoESeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CoE::create(['name' => 'THE ARTIFICIAL INTELLIGENCE & ROBOTICS CENTER']);
        CoE::create(['name' => 'MINERAL EXPLORATION, EXTRACTION AND PROCESSING CENTER']);
        CoE::create(['name' => 'HIGH-PERFORMANCE COMPUTING AND BIG DATA ANALYTICS (HPC & BDA) CENTER']);
    }
}
