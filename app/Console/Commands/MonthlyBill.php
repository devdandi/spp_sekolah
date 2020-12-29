<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Student;
use App\Models\Tunggakan;
use App\Models\Configuration;



class MonthlyBill extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monthly:bill';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automaticaly get the bill';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return 0;
        $student = Student::all();
        $config = Configuration::first()->spp_bulanan;
        
        foreach($student as $stu)
        {
            if($stu->nisn === null || $stu->class_id === null || $stu->status !== 1)
            {
                $this->info($stu->kkdetail->name . " tidak di masukan ke tunggakan, karena belum menjadi siswa/i di sekolah !");
            }else{
                Tunggakan::create([
                    'parent_id' => $stu->parent_id,
                    'student_id' => $stu->id,
                    'class_id' => $stu->class_id,
                    'total' => $config
                ]);
            }
        }
        $this->info('Tagihan bulan ' . date('M') . ' berhasil di tambahkan');
    }
}
