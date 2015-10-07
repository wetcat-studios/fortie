<?php
 
use Wetcat\Fortie\Fortie;

use Wetcat\Fortie\Accounts\Provider as AccountProvider;

use GuzzleHttp\Client as Guzzle;

class FortieTest extends PHPUnit_Framework_TestCase {
 

  public function test_has_accounts_provider()
  {
    $client = new Guzzle;

    $fortie = new Fortie(new AccountProvider($client));

    $this->assertNotNull($fortie->accounts());
  }
 

}