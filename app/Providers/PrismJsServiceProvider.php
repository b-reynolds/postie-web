<?php

namespace App\Providers;

use App\PrismJs\PrismJsLanguage;
use App\PrismJs\PrismJsService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;

class PrismJsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(PrismJsService::class, function ($app) {
            $supportedLanguagesJson = json_decode(Storage::disk('local')->get('json/prism-js-languages.json'), true);

            $supportedLanguages = [];
            foreach($supportedLanguagesJson as $title => $alias) {
                array_push($supportedLanguages, new PrismJsLanguage($title, $alias));
            }

            return new PrismJsService($supportedLanguages);
        });
    }
}
