<?php namespace Wetcat\Fortie\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use Config;

class ActivateCommand extends Command {

  /**
   * The console command name.
   *
   * @var string
   */
  protected $name = 'fortie:activate';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Get the access token from a new Authorization-Code (Should only be done once for each code)';

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Execute the console command.
   *
   * @return mixed
   */
  public function fire()
  {
    // Get the Authorization-Code
    $auth_code = $this->argument('code');

    // Get the config options
    $client_secret  = Config::get('fortie.default.client_secret', Config::get('fortie::default.client_secret'));
    $content_type   = Config::get('fortie.default.content_type', Config::get('fortie::default.content_type'));
    $accepts        = Config::get('fortie.default.accepts', Config::get('fortie::default.accepts'));
    $endpoint       = Config::get('fortie.default.endpoint', Config::get('fortie::default.endpoint'));

    // Construct the Guzzle client
    $client = new \GuzzleHttp\Client([
      'base_uri'  => $endpoint,
      'headers'   => [
        'Authorization-Code'  => $auth_code,
        'Client-Secret'       => $client_secret,
        'Content-Type'        => $content_type,
        'Accept'              => $accepts
      ],
      'timeout'   => 3.0,
    ]);

    $res = $client->get();

    $this->info('Your access token is: ' . $res); 
  }

  /**
   * Get the console command arguments.
   *
   * @return array
   */
  protected function getArguments()
  {
    return array(
      array('code', InputArgument::REQUIRED, 'The provider Authorization-Code.'),
    );
  }

}