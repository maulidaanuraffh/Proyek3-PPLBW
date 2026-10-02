<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivityBulkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $workshop  = \App\Models\Category::where('slug', 'workshop')->first()->id;
        $seminar   = \App\Models\Category::where('slug', 'seminar')->first()->id;
        $praktikum = \App\Models\Category::where('slug', 'praktikum')->first()->id;

        \App\Models\Activity::insert([
            ['category_id' => $workshop,  'code' => 'WS-001', 'title' => 'Workshop Git Dasar',         'description' => 'Latihan kolaborasi repository.',              'location' => 'Lab Komputer 1', 'capacity' => 30, 'activity_date' => '2026-10-05', 'start_at' => '2026-10-05 09:00:00', 'end_at' => '2026-10-05 12:00:00', 'status' => 'draft',      'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $workshop,  'code' => 'WS-002', 'title' => 'Workshop Docker Dasar',      'description' => 'Pengenalan container dan image.',              'location' => 'Lab Komputer 2', 'capacity' => 25, 'activity_date' => '2026-10-08', 'start_at' => '2026-10-08 09:00:00', 'end_at' => '2026-10-08 12:00:00', 'status' => 'draft',      'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $workshop,  'code' => 'WS-003', 'title' => 'Workshop Laravel API',       'description' => 'Membuat RESTful API dengan Laravel.',         'location' => 'Lab Komputer 1', 'capacity' => 20, 'activity_date' => '2026-10-15', 'start_at' => '2026-10-15 13:00:00', 'end_at' => '2026-10-15 16:00:00', 'status' => 'published', 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $workshop,  'code' => 'WS-004', 'title' => 'Workshop Testing PHP',       'description' => 'Unit test dengan PHPUnit.',                   'location' => 'Lab Komputer 3', 'capacity' => 20, 'activity_date' => '2026-10-20', 'start_at' => '2026-10-20 09:00:00', 'end_at' => '2026-10-20 12:00:00', 'status' => 'published', 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $workshop,  'code' => 'WS-005', 'title' => 'Workshop Clean Code',        'description' => 'Prinsip clean code dan refactoring.',         'location' => 'Lab Komputer 2', 'capacity' => 35, 'activity_date' => '2026-09-10', 'start_at' => '2026-09-10 09:00:00', 'end_at' => '2026-09-10 12:00:00', 'status' => 'completed', 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $seminar,   'code' => 'SM-001', 'title' => 'Seminar Web Quality',        'description' => 'Pengenalan maintainability dan testing.',      'location' => 'Aula Kampus',    'capacity' => 100,'activity_date' => '2026-10-12', 'start_at' => '2026-10-12 08:00:00', 'end_at' => '2026-10-12 12:00:00', 'status' => 'draft',      'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $seminar,   'code' => 'SM-002', 'title' => 'Seminar AI dan Masa Depan',  'description' => 'Dampak AI pada dunia kerja.',                 'location' => 'Aula Kampus',    'capacity' => 150,'activity_date' => '2026-10-18', 'start_at' => '2026-10-18 08:00:00', 'end_at' => '2026-10-18 11:00:00', 'status' => 'published', 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $seminar,   'code' => 'SM-003', 'title' => 'Seminar Keamanan Siber',     'description' => 'Ancaman dan mitigasi keamanan siber.',        'location' => 'Aula Kampus',    'capacity' => 120,'activity_date' => '2026-10-25', 'start_at' => '2026-10-25 09:00:00', 'end_at' => '2026-10-25 12:00:00', 'status' => 'published', 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $seminar,   'code' => 'SM-004', 'title' => 'Seminar Karir IT',           'description' => 'Tips berkarir di industri teknologi.',        'location' => 'Aula Kampus',    'capacity' => 200,'activity_date' => '2026-09-05', 'start_at' => '2026-09-05 08:00:00', 'end_at' => '2026-09-05 11:00:00', 'status' => 'completed', 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $seminar,   'code' => 'SM-005', 'title' => 'Seminar Cloud Computing',    'description' => 'Pengenalan cloud dan layanannya.',            'location' => 'Aula Kampus',    'capacity' => 130,'activity_date' => '2026-11-02', 'start_at' => '2026-11-02 08:00:00', 'end_at' => '2026-11-02 11:00:00', 'status' => 'draft',      'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $praktikum, 'code' => 'PK-001', 'title' => 'Praktikum Laravel Dasar',   'description' => 'Membangun CRUD dengan Laravel.',              'location' => 'Lab Komputer 1', 'capacity' => 30, 'activity_date' => '2026-09-28', 'start_at' => '2026-09-28 13:00:00', 'end_at' => '2026-09-28 16:00:00', 'status' => 'completed', 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $praktikum, 'code' => 'PK-002', 'title' => 'Praktikum HTML dan CSS',    'description' => 'Pengenalan struktur HTML dan CSS.',           'location' => 'Lab Komputer 2', 'capacity' => 30, 'activity_date' => '2026-09-07', 'start_at' => '2026-09-07 13:00:00', 'end_at' => '2026-09-07 16:00:00', 'status' => 'completed', 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $praktikum, 'code' => 'PK-003', 'title' => 'Praktikum JavaScript',      'description' => 'Interaktivitas web dengan JavaScript.',       'location' => 'Lab Komputer 3', 'capacity' => 30, 'activity_date' => '2026-09-14', 'start_at' => '2026-09-14 13:00:00', 'end_at' => '2026-09-14 16:00:00', 'status' => 'completed', 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $praktikum, 'code' => 'PK-004', 'title' => 'Praktikum Database MySQL',  'description' => 'Query dasar dan relasi tabel.',               'location' => 'Lab Komputer 1', 'capacity' => 25, 'activity_date' => '2026-10-10', 'start_at' => '2026-10-10 13:00:00', 'end_at' => '2026-10-10 16:00:00', 'status' => 'draft',      'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $praktikum, 'code' => 'PK-005', 'title' => 'Praktikum Pemrograman OOP', 'description' => 'Konsep OOP dalam PHP.',                      'location' => 'Lab Komputer 2', 'capacity' => 25, 'activity_date' => '2026-10-22', 'start_at' => '2026-10-22 13:00:00', 'end_at' => '2026-10-22 16:00:00', 'status' => 'published', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
