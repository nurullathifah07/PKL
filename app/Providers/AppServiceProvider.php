<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Barang;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {

            $barangHabis = Barang::where('stok', 0)
                ->whereHas('barangKeluarDetail')
                ->get();

            $barangMenipis = Barang::whereColumn('stok', '<=', 'stok_minimal')
                ->where('stok', '>', 0)
                ->whereHas('barangKeluarDetail')
                ->get();

            $totalNotif = $barangHabis->count() + $barangMenipis->count();

            $lastClearedTotal = session('last_cleared_total', null);

            // Kalau belum pernah clear → tampilkan badge
            if ($lastClearedTotal === null) {
                $badgeNotif = $totalNotif;
            } else {
                // Kalau jumlah sekarang beda dengan terakhir clear → munculkan lagi
                $badgeNotif = ($totalNotif != $lastClearedTotal) ? $totalNotif : 0;
            }

            $view->with([
                'barangHabis' => $barangHabis,
                'barangMenipis' => $barangMenipis,
                'totalNotif' => $totalNotif,
                'badgeNotif' => $badgeNotif
            ]);
        });
    }
}
