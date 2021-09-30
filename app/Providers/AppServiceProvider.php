<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        Blade::directive('rupiah', function ($money) {
            return "<?php echo 'Rp.'.number_format($money, 2,',','.'); ?>";
        });
        Gate::define('admin', function (User $user) {
            return $user->role_id === "2";
        });
        Gate::define('pemilik', function (User $user) {
            return $user->role_id === "1";
        });
    }
}
