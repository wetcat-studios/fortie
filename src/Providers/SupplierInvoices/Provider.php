<?php namespace Wetcat\Fortie\Providers\SupplierInvoices;

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
    'AccountingMethod',
    'AdministrationFee',
    'Balance',
    'Booked',
    'Cancelled',
    'Comments',
    'CostCenter',
    'Credit',
    'CreditReference',
    'Currency',
    'CurrencyRate',
    'CurrencyUnit',
    'CurrencyUnit',
    'DisablePaymentFile',
    'DueDate',
    'ExternalInvoiceNumber',
    'ExternalInvoiceSeries',
    'Freight',
    'GivenNumber',
    'InvoiceDate',
    'InvoiceNumber',
    'OCR',
    'OurReference',
    'Project',
    'RoundOffValue',
    'SalesType',
    'SupplierInvoiceRows',
    'SupplierNumber',
    'SupplierName',
    'Total',
    'VAT',
    'VATType',
    'YourReference',
  ];


  protected $writeable = [
    // 'Url',
    'AccountingMethod',
    'AdministrationFee',
    // 'Balance',
    // 'Booked',
    // 'Cancelled',
    'Comments',
    'CostCenter',
    // 'Credit',
    'CreditReference',
    'Currency',
    'CurrencyRate',
    'CurrencyUnit',
    'CurrencyUnit',
    'DisablePaymentFile',
    'DueDate',
    'ExternalInvoiceNumber',
    'ExternalInvoiceSeries',
    'Freight',
    'GivenNumber',
    'InvoiceDate',
    'InvoiceNumber',
    'OCR',
    'OurReference',
    'Project',
    // 'RoundOffValue',
    'SalesType',
    'SupplierInvoiceRows',
    'SupplierNumber',
    // 'SupplierName',
    // 'Total',
    'VAT',
    'VATType',
    'YourReference',
  ];


  protected $required_create = [
  ];


  protected $required_update = [
  ];


  /**
   * Override the REST path
   */
  protected $basePath = 'supplierinvoices';


  /**
   * Retrieves a list of invoices.
   *
   * @return array
   */
  public function all ($filter = null, $page = null)
  {
    $req = new FortieRequest();
    $req->method('GET');
    $req->path($this->basePath);

    if (!is_null($filter)) {
      $req->filter($filter);
    }

    if (!is_null($page)) {  
      $req->param('page', $page);
    }

    return $this->send($req->build());
  }


  /**
   * Retrieves a single invoice.
   *
   * @param $givenNumber
   * @return array
   */
  public function find ($givenNumber)
  {
    $req = new FortieRequest();
    $req->method('GET');
    $req->path($this->basePath)->path($givenNumber);

    return $this->send($req->build());
  }


  /**
   * Creates a supplier invoice.
   *
   * @param $givenNumber
   * @param array   $data
   * @return array
   */
  public function create ($givenNumber, array $data)
  {
    $req = new FortieRequest();
    $req->method('POST');
    $req->path($this->basePath)->path($givenNumber);
    $req->wrapper('SupplierInvoice');
    $req->data($data);
    $req->setRequired($this->required_create);

    return $this->send($req->build());
  }


  /**
   * Updates a supplier invoice.
   *
   * @param $givenNumber
   * @param array   $data
   * @return array
   */
  public function update ($givenNumber, array $data)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($givenNumber);
    $req->wrapper('SupplierInvoice');
    $req->setRequired($this->required_update);
    $req->data($data);

    return $this->send($req->build());
  }


  /**
   * Bookkeeps the supplier invoice
   *
   * @param $number
   * @return array
   */
  public function bookkeep ($number)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($number)->path('bookkeep');

    return $this->send($req->build());
  }


  /**
   * Cancels the supplier invoice
   *
   * @param $number
   * @return array
   */
  public function cancel ($number)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($number)->path('cancel');

    return $this->send($req->build());
  }


  /**
   * Creates a credit of the supplier invoice
   *
   * @param $number
   * @return array
   */
  public function credit ($number)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($number)->path('credit');

    return $this->send($req->build());
  }


  /**
   * Approval of payment of the supplier invoice
   *
   * @param $number
   * @return array
   */
  public function approvalpayment ($number)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($number)->path('approvalpayment');

    return $this->send($req->build());
  }


  /**
   * Approval of bookkeep of the supplier invoice
   *
   * @param $number
   * @return array
   */
  public function approvalbookkeep ($number)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($number)->path('approvalbookkeep');

    return $this->send($req->build());
  }

}
