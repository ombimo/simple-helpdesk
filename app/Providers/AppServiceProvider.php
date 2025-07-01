<?php

namespace App\Providers;

use App\Settings\AppSettings;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
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
        Model::unguard();
        $request = request();

        // Force HTTPS scheme if the application is behind a proxy
        if (config('app.behind_proxy') && ! $this->isFromLocal($request)) {
            URL::forceScheme('https');
        }

        if ($this->isFromLocal($request)) {
            Storage::forgetDisk('public');
            Config::set('app.url', $request->getSchemeAndHttpHost());
            Config::set('filesystems.disks.public.url', $request->getSchemeAndHttpHost().'/storage');
        }

        //TODO: cara cari cara yang lebih elegan, karena ketika diawal app belum ada db akan throw error
        //region Set System Settings
        try {
            $appSettings = app(AppSettings::class);

            Config::set('app.locale', $appSettings->locale);
            Config::set('app.name', $appSettings->name);
            Config::set('turnstile.turnstile_secret_key', $appSettings->turnstile_secret_key);
            Config::set('turnstile.turnstile_site_key', $appSettings->turnstile_site_key);

        } catch (\Exception $e) {
            // Handle the exception if needed
        }
        //endregion

    }

    private function isFromLocal(Request $request): bool
    {
        $localHosts = config('app.local_urls');

        return in_array($request->getSchemeAndHttpHost(), $localHosts);
    }
}
