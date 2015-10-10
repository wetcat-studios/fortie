<?php namespace Wetcat\Fortie\Currencies;

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
    'BuyRate',
    'Code',
    'Date',
    'Description',
    'SellRate',
    'Unit',
  ];

  protected $writeable = [
    'BuyRate',
    'Code',
    'Description',
    'SellRate',
    'Unit',
  ];

  protected $required = [
    'Code',
    'Description',
  ];

  /**
   * Override the REST path
   */
  protected $path = 'currencies';


  /**
   * Retrieves a list of currencies.
   *
   * @return array
   */
  public function all ()
  {
    return $this->sendRequest('GET');
  }


  /**
   * Retrieves a single currency.
   *
   * @param $id
   * @return array
   */
  public function find ($id)
  {
    return $this->sendRequest('GET', $id);
  }


  /**
   * Creates a currency.
   *
   * @param array   $params
   * @return array
   */
  public function create (array $params)
  {
    return $this->sendRequest('POST', null, 'Currency', $params);
  }


  /**
   * Updates a currency.
   *
   * @param array   $params
   * @return array
   */
  public function update ($id, array $params)
  {
    return $this->sendRequest('PUT', $id, 'Currency', $params);
  }


  /**
   * Removes a currency.
   */
  public function delete ($id)
  {
    throw new Exception('Not implemented');
  }


}