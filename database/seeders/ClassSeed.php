<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoomClass;
class ClassSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RoomClass::create([
            'classes' => 12,
            'major_id' => 1,
            'name' => 'RPL',
            'full' => 1
        ]);
    }
}
