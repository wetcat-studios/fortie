<?php namespace Wetcat\Fortie;

use Illuminate\Support\ServiceProvider;

use Wetcat\Fortie\Config;

use Wetcat\Fortie\Accounts\Provider as AccountsProvider;

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
  }

  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    $this->registerAccountProvider();
    
    $this->registerCommands();

    $this->registerFortie();

/*
    $this->app->booting(function()
    {
      $loader = \Illuminate\Foundation\AliasLoader::getInstance();
      $loader->alias('Fortie', 'Wetcat\Fortie\Facades\Fortie');
    });
*/
/*
    $this->app->singleton('Wetcat\Fortie\Fortie', function ($app) {
        return new Fortie(config('riak'));
    });
*/
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

      $client = new GuzzleHttp\Client();

      // Set all headers
      $client->setDefaultOption('headers', [
        'Access-Token'  => $access_token,
        'Client-Secret' => $client_secret,
        'Content-Type'  => $content_type,
        'Accept'        => $accepts
      ]);

      return new Fortie(
        new AccountsProvider($client)
      );
    });
  }

  /**
   * Register the accounts provider used by Fortie.
   *
   * @return void
   */
  protected function registerAccountProvider()
  {
/*
    $this->app['fortie.accounts'] = $this->app->share(function ($app)
    {
      return new AccountsProvider();
    });
*/
  }

  protected function registerCommands()
  {
    // Register Fortnox commands
  }
}
