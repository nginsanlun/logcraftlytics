<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LogLevel;

class LogLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $logLevel = ['INFO', 'DEBUG', 'ERROR', 'WARNING', 'NOTICE'];
        foreach($logLevel as $level)
        {
            LogLevel::create([
                'level' => $level
            ]);
        }
    }
}
