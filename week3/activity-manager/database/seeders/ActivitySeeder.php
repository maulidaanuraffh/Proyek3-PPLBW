<?php
namespace Database\Seeders;
use App\Models\Activity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    public function run():void
    {
        Activity::query()->insert([ 
            [ 
                'title' => 'Workshop Git Dasar', 
                'description' => 'Latihan kolaborasi repository.', 
                'activity_date' => '2026-10-05', 
                'category' => 'Workshop', 
                'status' => 'Planned', 
                'created_at' => now(), 
                'updated_at' => now(), 
            ], 
            [ 
                'title' => 'Seminar Web Quality', 
                'description' => 'Pengenalan maintainability dan testing.', 
                'activity_date' => '2026-10-12', 
                'category' => 'Seminar', 
                'status' => 'Planned', 
                'created_at' => now(), 
                'updated_at' => now(), 
            ], 
            [
                'title'         => 'Praktikum Laravel Dasar',
                'description'   => 'Membangun CRUD sederhana menggunakan framework Laravel.',
                'activity_date' => '2026-09-28',
                'category'      => 'Praktikum',
                'status'        => 'Ongoing',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'title'         => 'Pengenalan HTML dan CSS',
                'description'   => 'Pengenalan struktur dokumen HTML dan dasar-dasar styling CSS.',
                'activity_date' => '2026-09-07',
                'category'      => 'Praktikum',
                'status'        => 'Done',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'title'         => 'Vanilla JavaScript dan DOM',
                'description'   => 'Interaktivitas web menggunakan JavaScript murni tanpa framework.',
                'activity_date' => '2026-09-14',
                'category'      => 'Praktikum',
                'status'        => 'Done',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]); 
    }
}
