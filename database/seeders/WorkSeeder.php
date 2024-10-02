<?php

namespace Database\Seeders;

use App\Models\Work;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Work::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            'Kepala Sekolah', 'Guru', 'Siswa'
        ];
        foreach ($data as $value) {
            Work::insert([
                'name'=>$value
            ]);
        }
    }
}
