<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Secret route to run migrations on shared hosting (InfinityFree)
Route::get('/install-database-infinityfree', function () {
    try {
        // Bersihkan cache lama
        \Illuminate\Support\Facades\Artisan::call('optimize:clear');
        
        // Buat symlink storage
        \Illuminate\Support\Facades\Artisan::call('storage:link');

        // Jalankan migrasi dan seeder
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        \Illuminate\Support\Facades\Artisan::call('laravolt:indonesia:seed');
        
        return '<h1>✅ Berhasil!</h1><p>Database ter-migrate, seeder wilayah terisi, symlink storage dibuat, dan cache dibersihkan.</p><p><b>SANGAT PENTING:</b> Segera hapus route ini dari routes/web.php demi keamanan web Anda!</p>';
    } catch (\Exception $e) {
        return '<h1>❌ Error:</h1><p>' . $e->getMessage() . '</p>';
    }
});
