<?php namespace Wetcat\Fortie\Accounts;

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

use Wetcat\Fortie\ProviderBase;


class Provider extends ProviderBase {


  protected $attributes = [
    'Url',
    'Active',
    'BalanceBroughtForward',
    'BalanceCarriedForward',
    'CostCenter',
    'CostCenterSettings',
    'Description',
    'Number',
    'Project',
    'ProjectSettings',
    'SRU',
    'TransactionInformation',
    'TransactionInformationSettings',
    'VATCode',
    'Year',
  ];

  protected $writeable = [
    'Active',
    'BalanceBroughtForward',
    'CostCenter',
    'CostCenterSettings',
    'Description',
    'Number',
    'Project',
    'ProjectSettings',
    'SRU',
    'TransactionInformation',
    'TransactionInformationSettings',
    'VATCode',
  ];

  protected $required = [
    'Description', 
    'Number',
  ];

  /**
   * Override the REST path
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
    return $this->sendRequest('GET');
  }


  /**
   * Retrieves the details of an account. You need to supply the unique 
   * account number that was returned when the account was created or 
   * retrieved from the list of accounts.
   *
   * @param $id
   * @return array
   */
  public function retrieveAccount ($id)
  {
    return $this->sendRequest('GET', $id);
  }


  /**
   * The created account will be returned if everything succeeded, if 
   * there was any problems an error will be returned.
   *
   * @param array   $params
   * @return array
   */
  public function createAccount (array $params)
  {
    return $this->sendRequest('POST', null, 'Account', $params);
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
  public function updateAccount ($id, array $params)
  {
    return $this->sendRequest('PUT', $id, 'Account', $params);
  }


}