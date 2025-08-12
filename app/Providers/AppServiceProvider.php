<?php

namespace App\Providers;

use App\Models\KetQua;
use App\Observers\KetQuaObserver;
use Illuminate\Support\ServiceProvider;

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
    KetQua::observe(KetQuaObserver::class);
  }
}
