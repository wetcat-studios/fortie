<?php namespace Wetcat\Fortie\Commands;

/*

   Copyright 2015 Andreas Göransson

   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

       http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.

*/

use Illuminate\Console\Command;

use Config;

class ActivateCommand extends Command
{

  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'fortie:activate {code : The Authorization-Code}';


  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Get the access token from a new Authorization-Code (Should only be done once for each code).';


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
  public function handle()
  {
    // Get the Authorization-Code
    $auth_code = $this->argument('code');

    // Get the config options
    $client_secret  = Config::get('fortie.default.client_secret', Config::get('fortie::default.client_secret'));
    $content_type   = Config::get('fortie.default.content_type', Config::get('fortie::default.content_type'));
    $accepts        = Config::get('fortie.default.accepts', Config::get('fortie::default.accepts'));
    $endpoint       = Config::get('fortie.default.endpoint', Config::get('fortie::default.endpoint'));

    try {
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
      $res = $client->request('GET');
      $this->info($res->getBody()->getContents());
    }
    catch (\GuzzleHttp\Exception\ClientException $e) {
      $response = $e->getResponse();
      $responseBodyAsString = $response->getBody()->getContents();
      
      $this->error('Failed to generate access token!');
      $this->error($responseBodyAsString);
    }
  }

}
