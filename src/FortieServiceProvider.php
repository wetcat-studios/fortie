<?php namespace Wetcat\Fortie;

use Illuminate\Support\ServiceProvider;

use Config;

use Wetcat\Fortie\Accounts\Provider as AccountsProvider;
use Wetcat\Fortie\Articles\Provider as ArticlesProvider;
use Wetcat\Fortie\CompanySettings\Provider as CompanySettingsProvider;

class FortieServiceProvider extends ServiceProvider
{

  /**
   * Indicates if loading of the provider is deferred.
   *
   * @var bool
   */
  protected $defer = false;
  

  protected $accountsProvider = null;
  
  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    //$this->package('wetcat/fortie');

    $this->publishes([
      __DIR__.'/config/config.php' => config_path('fortie.php'),
    ]);
  }

  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    $this->mergeConfigFrom(
      __DIR__.'/config/config.php', 'fortie'
    );
    
    $this->registerCommands();

    $this->registerFortie();
  }

  /**
   * Get the services provided by the provider.
   *
   * @return array
   */
  public function provides()
  {
    return array();
  }

  /**
   * Creates a new Fortie object
   *
   * @return void
   */
  protected function registerFortie()
  {
    $this->app->singleton('Wetcat\Fortie\Fortie', function ($app) 
    {  
      $access_token   = Config::get('fortie.default.access_token', Config::get('fortie::default.access_token'));
      $client_secret  = Config::get('fortie.default.client_secret', Config::get('fortie::default.client_secret'));
      $content_type   = Config::get('fortie.default.content_type', Config::get('fortie::default.content_type'));
      $accepts        = Config::get('fortie.default.accepts', Config::get('fortie::default.accepts'));
      $endpoint       = Config::get('fortie.default.endpoint', Config::get('fortie::default.endpoint'));

      $client = new \GuzzleHttp\Client([
        'base_uri'  => $endpoint,
        'headers'   => [
          'Access-Token'  => $access_token,
          'Client-Secret' => $client_secret,
          'Content-Type'  => $content_type,
          'Accept'        => $accepts
        ],
        'timeout'   => 3.0,
      ]);

      return new Fortie(
        new AccountsProvider($client),
        new ArticlesProvider($client),
        new CompanySettingsProvider($client)
      );
    });
  }

  protected function registerCommands()
  {
    // Register Fortnox commands
  }
}
