<?php

namespace App\Providers;

use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Policies\PeminjamanPolicy;
use App\Policies\PengembalianPolicy;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        Peminjaman::class => PeminjamanPolicy::class,
        Pengembalian::class => PengembalianPolicy::class,
    ];

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
        Paginator::useBootstrap();
    }
}
