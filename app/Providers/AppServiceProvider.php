<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;

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
        // Nếu đang chạy artisan trên console, dừng sớm để không gọi Setting::get()
        if ($this->app->runningInConsole()) {
            return;
        }

        // Chỉ share nếu bảng settings thực sự đã tồn tại
        if (Schema::hasTable('settings')) {
            view()->share('siteName', Setting::get('site_name', 'Chiêm Tinh Vui'));
            view()->share('siteLogo', Setting::get('site_logo', asset('image/icon.png')));
        }
    }


}
