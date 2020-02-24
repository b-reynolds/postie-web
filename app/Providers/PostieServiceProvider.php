<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Postie\GuzzlePostieService;
use App\Postie\PostieService;
use App\PrismJs\PrismJsService;

class PostieServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(PostieService::class, function ($app) {
            $postie = new GuzzlePostieService(env('POSTIE_BASE_URI'), env('POSTIE_API_KEY'));
            $prismJs = $app[PrismJsService::class];

            foreach ($this->getMissingFileTypes($postie, $prismJs) as $language) {
                $postie->createFileType($language->title);
            }

            return $postie;
        });
    }

    private function getMissingFileTypes(PostieService $postie, PrismJsService $prismJs): array
    {
        $availableFileTypes = $postie->getFileTypes();
        $missingFileTypes = [];
        
        foreach ($prismJs->supportedLanguages as $language) {
            $exists = false;
            foreach ($availableFileTypes as $fileType) {
                if ($fileType->name == $language->title) {
                    $exists = true;
                    break;
                }
            }

            if (!$exists) {
                array_push($missingFileTypes, $language);
            }
        }

        return $missingFileTypes;
    }
}
