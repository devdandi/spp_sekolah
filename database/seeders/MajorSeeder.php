<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Major;

class MajorSeeder extends Seeder
{
    protected $major;
    function __construct(Major $major)
    {
        $this->major = $major;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $major = array(
            'Rekayasa Perangkat Lunak',
            'Desain Komunikasi Visual',
            'Animasi',
            'Multimedia',
            'Teknik Komputer Jaringan'
        );

        if($this->major->count() <= 0 )
        {
            for($i = 0; $i < count($major); $i++)
            {
                $this->major->create([
                    'name' => $major[$i]
                ]);
            }
        }
    }
}
