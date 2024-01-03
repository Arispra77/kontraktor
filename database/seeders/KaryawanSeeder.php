<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KaryawanSeeder extends Seeder
{
    public function run()
    {
        DB::table('ts_karyawan_sk')->insert([
            'nama_kary' => 'KTR-162',
            'nama_kary1' => ' UMP, PT2',
            'bagian_kary' => 'KTR-162',
            'Password' => sha1('ump123'), // Menggunakan Hash untuk password
            'status' => '0',
        ]);
        
       
       
        // Tambahkan data lain sesuai kebutuhan
    }
}

