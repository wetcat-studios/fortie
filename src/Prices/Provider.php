<?php namespace Wetcat\Fortie\Prices;

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
    'ArticleNumber',
    'Date',
    'FromQuantity',
    'Percent',
    'Price',
    'PriceList',
  ];

  protected $writeable = [
    'ArticleNumber',
    'FromQuantity',
    'Percent',
    'Price',
    'PriceList',
  ];

  protected $required = [
    'ArticleNumber',
    'FromQuantity',
    'PriceList',
  ];

  /**
   * Override the REST path
   */
  protected $path = 'prices';


  /**
   * Retrieves a list of prices in a price list
   *
   * @return array
   */
  public function all ($priceList, $articleNumber)
  {
    return $this->sendRequest('GET', [$priceList, $articleNumber]);
  }


  /**
   * Retrives a price for a specified article.
   *
   * @param $id
   * @return array
   */
  public function article ($priceList, $articleNumber, $fromQuantity)
  {
    return $this->sendRequest('GET', [$priceList, $articleNumber, $fromQuantity]);
  }


  /**
   * Creates a price.
   *
   * @param array   $params
   * @return array
   */
  public function create (array $params)
  {
    return $this->sendRequest('POST', null, 'Price', $params);
  }


  /**
   * Updates a price.
   *
   * @param array   $params
   * @return array
   */
  public function update ($priceList, $articleNumber, $fromQuantity, array $params)
  {
    return $this->sendRequest('PUT', [$priceList, $articleNumber, $fromQuantity], 'Price', $params);
  }


  /**
   * Removes a price.
   */
  public function delete ($priceList, $articleNumber, $fromQuantity)
  {
    throw new Exception('Not implemented');
  }


}