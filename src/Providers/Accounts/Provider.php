<?php namespace Wetcat\Fortie\Providers\Accounts;

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

use Wetcat\Fortie\Providers\ProviderBase;
use Wetcat\Fortie\FortieRequest;

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


  protected $required_create = [
    'Description', 
    'Number',
  ];


  protected $required_update = [
    'Number',
  ];


  /**
   * Override the REST path
   */
  protected $basePath = 'accounts';


  /**
   * Retrieves a list of accounts. The accounts are returned sorted 
   * by account number with the lowest number appearing first.
   *
   * @return array
   */
  public function all ($page = null)
  {
    $req = new FortieRequest();
    $req->method('GET');
    $req->path($this->basePath);

    if (!is_null($page)) {  
      $req->param('page', $page);
    }

    return $this->send($req->build());
  }


  /**
   * Retrieves the details of an account. You need to supply the unique 
   * account number that was returned when the account was created or 
   * retrieved from the list of accounts.
   *
   * @param $id
   * @return array
   */
  public function find ($id)
  {
    $req = new FortieRequest();
    $req->method('GET');
    $req->path($this->basePath)->path($id);

    return $this->send($req->build());
  }


  /**
   * The created account will be returned if everything succeeded, if 
   * there was any problems an error will be returned.
   *
   * @param array   $data
   * @return array
   */
  public function create (array $data)
  {
    $req = new FortieRequest();
    $req->method('POST');
    $req->path($this->basePath);
    $req->wrapper('Account');
    $req->data($data);
    $req->setRequired($this->required_create);

    return $this->send($req->build());
  }


  /**
   * Updates the specified account with the values provided in the 
   * properties. Any property not provided will be left unchanged.
   *
   * Note that even though the account number is writeable you can’t 
   * change the number of an existing account.
   *
   * @param array   $data
   * @return array
   */
  public function update ($id, array $data)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($id);
    $req->wrapper('Account');
    $req->setRequired($this->required_update);
    $req->data($data);

    return $this->send($req->build());
  }

}
