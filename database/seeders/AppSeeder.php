<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\Level;
use App\Models\User;
use App\Models\Configuration;


class AppSeeder extends Seeder
{
    private $user, $level, $config;

    function __construct(User $user, Level $level, Configuration $c)
    {
        $this->config = $c;
        $this->user = $user;
        $this->level = $level;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $level = array(
            'GURU',
            'ADMINISTRATOR',
            'PENGGUNA',
            'SUPERUSER'
        );
        // ADD LEVEL
        if($this->level->count() <= 0)
        {
            for($i = 0; $i < count($level); $i++)
            {
                $this->level->create([
                    'keterangan' => $level[$i]
                ]);
            }
        }
        // END LEVEL
        

        // ADD USER
        if($this->user->count() < 1)
        {
            $this->user->create([
                'nip' => 2138732148912,
                'name' => 'Dandi Ramdani',
                'email' => 'dandiduit@gmail.com',
                'password' => Hash::make('dandi129'),
                'level_id' => 4,
                'status' => 1
            ]);
        }
        // END USER

        // CONFIGURATION
        if($this->config->count() < 1)
        {
            $this->config->create([
                'client_key' => 'none',
                'secret_key' => 'none',
                'url' => 'http://localhost',
                'spp_bulanan' => 0
            ]);
        }
        // END CONFIGURATION
    }
}
