<?php
namespace Database\Seeders;
use App\Models\Activity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        $workshop  = \App\Models\Category::where('slug', 'workshop')->first()->id;
        $seminar   = \App\Models\Category::where('slug', 'seminar')->first()->id;
        $praktikum = \App\Models\Category::where('slug', 'praktikum')->first()->id;

        Activity::query()->insert([
            [
                'category_id'   => $workshop,
                'title'         => 'Workshop Git Dasar',
                'description'   => 'Latihan kolaborasi repository.',
                'activity_date' => '2026-10-05',
                'status'        => 'Planned',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'category_id'   => $seminar,
                'title'         => 'Seminar Web Quality',
                'description'   => 'Pengenalan maintainability dan testing.',
                'activity_date' => '2026-10-12',
                'status'        => 'Planned',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'category_id'   => $praktikum,
                'title'         => 'Praktikum Laravel Dasar',
                'description'   => 'Membangun CRUD sederhana menggunakan framework Laravel.',
                'activity_date' => '2026-09-28',
                'status'        => 'Ongoing',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'category_id'   => $praktikum,
                'title'         => 'Pengenalan HTML dan CSS',
                'description'   => 'Pengenalan struktur dokumen HTML dan dasar-dasar styling CSS.',
                'activity_date' => '2026-09-07',
                'status'        => 'Done',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'category_id'   => $praktikum,
                'title'         => 'Vanilla JavaScript dan DOM',
                'description'   => 'Interaktivitas web menggunakan JavaScript murni tanpa framework.',
                'activity_date' => '2026-09-14',
                'status'        => 'Done',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}
