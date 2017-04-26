<?php namespace Wetcat\Fortie\Providers\Prices;

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

use Wetcat\Fortie\Exceptions\MissingRequiredAttributeException;
use Wetcat\Fortie\Providers\ProviderBase;
use Wetcat\Fortie\FortieRequest;

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


  protected $required_create = [
    'ArticleNumber',
    'FromQuantity',
    'PriceList',
  ];


  protected $required_update = [
  ];


  /**
   * Override the REST path
   */
  protected $basePath = 'prices';


  /**
   * Retrieves a list of prices in a price list
   *
   * @return array
   */
  public function priceList ($priceList = null, $articleNumber = null)
  {
    if (is_null($priceList) || is_null($articleNumber)) {
      throw new MissingRequiredAttributeException(['priceList', 'articleNumber']);
    }

    $req = new FortieRequest();
    $req->method('GET');
    $req->path($this->basePath)->path($priceList)->path($articleNumber);

    return $this->send($req->build());
  }


  /**
   * Retrives a price for a specified article.
   *
   * @param $id
   * @return array
   */
  public function article ($priceList = null, $articleNumber = null, $fromQuantity = null)
  {
    if (is_null($priceList) || is_null($articleNumber) || is_null($fromQuantity)) {
      throw new MissingRequiredAttributeException(['priceList', 'articleNumber', 'fromQuantity']);
    }

    $req = new FortieRequest();
    $req->method('GET');
    $req->path($this->basePath)->path($priceList)->path($articleNumber)->oath($fromQuantity);

    return $this->send($req->build());
  }


  /**
   * Creates a price.
   *
   * @param array   $data
   * @return array
   */
  public function create (array $data)
  {
    $req = new FortieRequest();
    $req->method('POST');
    $req->path($this->basePath);
    $req->wrapper('Price');
    $req->setRequired($this->required_create);
    $req->data($data);

    return $this->send($req->build());
  }


  /**
   * Updates a price.
   *
   * @param array   $data
   * @return array
   */
  public function update ($priceList = null, $articleNumber = null, $fromQuantity = null, array $data)
  {
    if (is_null($priceList) || is_null($articleNumber) || is_null($fromQuantity)) {
      throw new MissingRequiredAttributeException(['priceList', 'articleNumber', 'fromQuantity']);
    }

    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($priceList)->path($articleNumber)->path($fromQuantity);
    $req->wrapper('Price');
    $req->setRequired($this->required_update);
    $req->data($data);

    return $this->send($req->build());
  }


  /**
   * Removes a price.
   */
  public function delete ($priceList = null, $articleNumber = null, $fromQuantity = null)
  {
    if (is_null($priceList) || is_null($articleNumber) || is_null($fromQuantity)) {
      throw new MissingRequiredAttributeException(['priceList', 'articleNumber', 'fromQuantity']);
    }

    $req = new FortieRequest();
    $req->method('DELETE');
    $req->path($this->basePath)->path($priceList)->path($articleNumber)->path($fromQuantity);
    $req->wrapper('Price');
    $req->setRequired($this->required_update);
    $req->data($data);

    return $this->send($req->build());
  }

}
