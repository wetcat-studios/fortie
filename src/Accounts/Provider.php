<?php namespace Wetcat\Fortie\Accounts;


use Wetcat\Fortie\ProviderInterface;


class Provider implements ProviderInterface {


  protected $attributes = [
    'url', 
    'active', 
    'balanceBroughtForward', 
    'balanceCarriedForward',
    'costCenter', 
    'costCenterSettings', 
    'description', 
    'number',
    'project', 
    'projectSettings', 
    'sru', 
    'transactionInformation',
    'transactionInformationSettings', 
    'vatCode', 
    'year',
  ];


  protected $hidden = [
  ];

  protected $client = null;

  protected $url = '';

  /**
   * Create a new account provider.
   *
   * @return void
   */
  public function __construct(&$client)
  {
    $this->client = $client;
  }

  public function sendRequest ($method = 'GET')
  {
    $request = $this->client->createRequest($method, 'https://api.fortnox.se/3/accounts/1010');

    try {
        $request->addHeaders([
            'Access-Token'=>'61cf63ae-4ab9-4a95-9db5-753781c4f41f',
            'Client-Secret'=>'3Er4kHXZTJ',
            'Content-Type'=>'application/json',
            'Accept'=>'application/json',
        ]);

        $response = $client->send($request);
        echo "Response HTTP : " . $response->getStatusCode();
    }
    catch (RequestException $e) {
        echo "HTTP Request failed\n";
        echo $e->getRequest();
        if ($e->hasResponse()) {
            echo $e->getResponse();
        }
    }
  }


  /**
   * Retrieves a list of accounts. The accounts are returned sorted 
   * by account number with the lowest number appearing first.
   *
   * @return array
   */
  public function listAllAccounts ()
  {

  }


  /**
   * Retrieves the details of an account. You need to supply the unique 
   * account number that was returned when the account was created or 
   * retrieved from the list of accounts.
   *
   * @param array   $params
   * @return array
   */
  public function retrieveAccount(array $params)
  {

  }


  /**
   * The created account will be returned if everything succeeded, if 
   * there was any problems an error will be returned.
   *
   * @param array   $params
   * @return array
   */
  public function createAccount(array $params)
  {

  }


  /**
   * Updates the specified account with the values provided in the 
   * properties. Any property not provided will be left unchanged.
   *
   * Note that even though the account number is writeable you can’t 
   * change the number of an existing account.
   *
   * @param array   $params
   * @return array
   */
  public function updateAccount (array $params)
  {

  }


}