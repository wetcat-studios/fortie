<?php namespace Wetcat\Fortie\Providers\Articles;

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


  protected $required_create = [
    'Description', 
  ];


  protected $required_update = [
    'ArticleNumber', 
  ];


  /**
   * Override the REST path
   */
  protected $basePath = 'articles';


  /**
   * Retrieves a list of articles. The articles are returned sorted by 
   * article number with the lowest number appearing first.
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
   * Retrieves the details of an article. You need to supply the unique 
   * article number that was returned when the article was created or 
   * retrieved from the list of articles.
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
   * The created article will be returned if everything succeeded, if 
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
    $req->wrapper('Article');
    $req->setRequired($this->required_create);
    $req->data($data);

    return $this->send($req->build());
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
   * @param array   $data
   * @return array
   */
  public function update ($id, array $data)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($id);
    $req->wrapper('Article');
    $req->setRequired($this->required_update);
    $req->data($data);

    return $this->send($req->build());
  }


  /**
   * Deletes the article permanently.
   *
   * You need to supply the unique article number that was returned when the 
   * article was created or retrieved from the list of articles.
   */
  public function delete ($id)
  {
    $req = new FortieRequest();
    $req->method('DELETE');
    $req->path($this->basePath);
    $req->path($id);

    return $this->send($req->build());
  }

}
