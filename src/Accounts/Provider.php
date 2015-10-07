<?php namespace Wetcat\Fortie\Accounts;


use Wetcat\Fortie\ProviderBase;


class Provider extends ProviderBase {


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


  /**
   * Override the 
   */
  protected $path = 'accounts';


  /**
   * Retrieves a list of accounts. The accounts are returned sorted 
   * by account number with the lowest number appearing first.
   *
   * @return array
   */
  public function listAllAccounts ()
  {
    try {
      $response = $this->client->get($this->path);

      return $this->handleResponse($response);
    }
    catch (\GuzzleHttp\Exception\ClientException $e) {
      $response = $e->getResponse();
      $responseBodyAsString = $response->getBody()->getContents();
      echo $responseBodyAsString;
    }
    //
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