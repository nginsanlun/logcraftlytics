<?php

namespace Database\Seeders;

use App\Models\Method;
use Illuminate\Database\Seeder;

class MethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $method = ["GET", "POST", "PUT", "DELETE", "PATCH"];
        foreach($method as $name) 
        {
            Method::create([
                'name' => $name
            ]);
        }
    }
}
