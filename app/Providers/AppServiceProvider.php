<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Crypt;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('encrypt', function ($expression) {
            return "<?php echo Crypt::encrypt($expression); ?>";
        });
        
        Schema::defaultStringLength(191);
        ini_set('post_max_size', '1G');
        ini_set('upload_max_filesize', '1G');

        // \Debugbar::disable();
    }
}
