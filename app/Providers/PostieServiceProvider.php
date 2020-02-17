<?

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Postie\GuzzlePostieService;
use App\Postie\PostieService;

class PostieServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(PostieService::class, function ($app) {
            return new GuzzlePostieService(env('POSTIE_BASE_URI'), env('POSTIE_API_KEY'));
        });
    }
}
