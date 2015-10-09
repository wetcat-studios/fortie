<?php namespace Wetcat\Fortie\Accounts;


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
  public function listAllArticles ()
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
  public function retrieveArticle($id)
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
  public function createArticle(array $params)
  {
    return $this->sendRequest('POST', null, 'Account', $params);
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
  public function updateArticle ($id, array $params)
  {
    return $this->sendRequest('PUT', $id, 'Account', $params);
  }

  /**
   * Deletes the article permanently.
   *
   * You need to supply the unique article number that was returned when the 
   * article was created or retrieved from the list of articles.
   */
  public function deleteArticle ($id)
  {
    throw new Exception('Not implemented');
  }

}