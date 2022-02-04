<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Platform;

class PlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Platform::create([
            'name' => 'sms',
            'status' => Platform::STATUS_ENABLED
        ]);

        Platform::create([
            'name' => 'whatsapp',
            'status' => Platform::STATUS_ENABLED
        ]);

        Platform::create([
            'name' => 'email',
            'status' => Platform::STATUS_ENABLED
        ]);
    }
}