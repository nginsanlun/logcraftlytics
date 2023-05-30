<?php
namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status_codes = [200, 400, 403, 404, 405, 406, 407, 408, 411, 412, 500];
        foreach ($status_codes as $status_code) {
            Status::create([
                'status_code' => $status_code
            ]);
        }
    }
}
