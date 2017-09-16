<?php namespace Wetcat\Fortie\Providers\InvoiceAccruals;

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
    'AccrualAccount',
    'Description',
    'EndDate',
    'InvoiceAccrualRows',
    'InvoiceNumber',
    'Period',
    'RevenueAccount',
    'StartDate',
    'Times',
    'Total',
    'VATIncluded',
  ];


  protected $writeable = [
    // 'Url',
    'AccrualAccount',
    'Description',
    'EndDate',
    'InvoiceAccrualRows',
    'InvoiceNumber',
    'Period',
    'RevenueAccount',
    'StartDate',
    // 'Times',
    'Total',
    'VATIncluded',
  ];


  protected $required_create = [
  ];


  protected $required_update = [
  ];


  /**
   * Override the REST path
   */
  protected $basePath = 'invoiceaccruals';


  /**
   * Retrieves a list of invoice accruals.
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
   * Retrieves a single invoice accrual.
   *
   * @param $invoiceNumber
   * @return array
   */
  public function find ($invoiceNumber)
  {
    $req = new FortieRequest();
    $req->method('GET');
    $req->path($this->basePath)->path($invoiceNumber);

    return $this->send($req->build());
  }


  /**
   * Creates an invoice accrual.
   *
   * @param array   $data
   * @return array
   */
  public function create (array $data)
  {
    $req = new FortieRequest();
    $req->method('POST');
    $req->path($this->basePath);
    $req->wrapper('InvoiceAccrual');
    $req->data($data);
    $req->setRequired($this->required_create);

    return $this->send($req->build());
  }


  /**
   * Updates an invoice accrual.
   *
   * @param $invoiceNumber
   * @param array   $data
   * @return array
   */
  public function update ($invoiceNumber, array $data)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($invoiceNumber);
    $req->wrapper('InvoiceAccrual');
    $req->setRequired($this->required_update);
    $req->data($data);

    return $this->send($req->build());
  }


  /**
   * Removes an invoice accrual.
   *
   * @param $invoiceNumber
   * @return null
   */
  public function delete ($invoiceNumber)
  {
    $req = new FortieRequest();
    $req->method('DELETE');
    $req->path($this->basePath)->path($invoiceNumber);

    return $this->send($req->build());
  }

}
