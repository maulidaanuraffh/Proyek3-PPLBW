<?php
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CategoryController;
use App\Models\Activity;
use Illuminate\Support\Facades\Route; 
use Illuminate\Support\Facades\DB;
 
Route::get('/', function () {
    return redirect()->route('activities.index');
});

Route::get('/activities/trashed', [ActivityController::class, 'trashed'])
    ->name('activities.trashed');

Route::post('/activities/{activity}/restore', [ActivityController::class, 'restore'])
    ->name('activities.restore')
    ->withTrashed();

Route::resource('categories', CategoryController::class);

Route::resource('activities', ActivityController::class);

// EKSPERIMEN SEMENTARA - hapus setelah bukti diambil
// Route::get('/eksperimen-transaction', function () {
//     try {
//         DB::transaction(function () {
//             $category = \App\Models\Category::create([
//                 'name' => 'Eksperimen Transaction',
//                 'slug' => 'eksperimen-transaction',
//             ]);

//             \App\Models\Activity::create([
//                 'category_id'   => $category->id,
//                 'code'          => 'EKS-001',
//                 'title'         => 'Kegiatan Eksperimen',
//                 'description'   => 'Uji transaction.',
//                 'location'      => 'Lab Test',
//                 'capacity'      => 10,
//                 'activity_date' => '2026-10-10',
//                 'start_at'      => '2026-10-10 09:00:00',
//                 'end_at'        => '2026-10-10 12:00:00',
//                 'status'        => 'draft',
//             ]);

//             // throw new \RuntimeException('Simulasi kegagalan.');
//         });
//     } catch (\RuntimeException $e) {
//         return 'Exception ditangkap: ' . $e->getMessage();
//     }

//     return 'Transaction berhasil.';
// });
