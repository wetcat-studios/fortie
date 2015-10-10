<?php namespace Wetcat\Fortie\Articles;

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
    'Bulky',
    'ConstructionAccount',
    'Depth',
    'Description',
    'DisposableQuantity',
    'EAN',
    'EUAccount',
    'EUVATAccount',
    'ExportAccount',
    'Height',
    'Housework',
    'HouseworkType',
    'Manufacturer',
    'ManufacturerArticleNumber',
    'Note',
    'PurchaseAccount',
    'PurchasePrice',
    'QuantityInStock',
    'ReservedQuantity',
    'SalesAccount',
    'SalesPrice',
    'StockGoods',
    'StockPlace',
    'StockValue',
    'StockWarning',
    'SupplierName',
    'SupplierNumber',
    'Type',
    'Unit',
    'VAT',
    'WebshopArticle',
    'Weight',
    'Width',
    'Expired',
  ];

  protected $writeable = [
    'ArticleNumber',
    'Bulky',
    'ConstructionAccount',
    'Depth',
    'Description',
    'EAN',
    'EUAccount',
    'EUVATAccount',
    'ExportAccount',
    'Height',
    'Housework',
    'HouseworkType',
    'Manufacturer',
    'ManufacturerArticleNumber',
    'Note',
    'PurchaseAccount',
    'PurchasePrice',
    'QuantityInStock',
    'ReservedQuantity',
    'SalesAccount',
    'StockGoods',
    'StockPlace',
    'StockWarning',
    'SupplierNumber',
    'Type',
    'Unit',
    'VAT',
    'WebshopArticle',
    'Weight',
    'Width',
    'Expired',
  ];

  protected $required = [
    'Description', 
  ];

  /**
   * Override the REST path
   */
  protected $path = 'articles';


  /**
   * Retrieves a list of articles. The articles are returned sorted by 
   * article number with the lowest number appearing first.
   *
   * @return array
   */
  public function all ()
  {
    return $this->sendRequest('GET');
  }


  /**
   * Retrieves the details of an article. You need to supply the unique 
   * article number that was returned when the article was created or 
   * retrieved from the list of articles.
   *
   * @param $id
   * @return array
   */
  public function find ($id)
  {
    return $this->sendRequest('GET', $id);
  }


  /**
   * The created article will be returned if everything succeeded, if 
   * there was any problems an error will be returned.
   *
   * @param array   $params
   * @return array
   */
  public function create (array $params)
  {
    return $this->sendRequest('POST', null, 'Article', $params);
  }


  /**
   * Updates the specified article with the values provided in the properties.
   * Any property not provided will be left unchanged.
   *
   * You need to supply the unique article number that was returned when the 
   * article was created or retrieved from the list of articles.
   *
   * Note that even though the article number is writeable you can’t change the
   * number of an existing article.
   *
   * @param array   $params
   * @return array
   */
  public function update ($id, array $params)
  {
    return $this->sendRequest('PUT', $id, 'Article', $params);
  }

  /**
   * Deletes the article permanently.
   *
   * You need to supply the unique article number that was returned when the 
   * article was created or retrieved from the list of articles.
   */
  public function delete ($id)
  {
    throw new Exception('Not implemented');
  }

}