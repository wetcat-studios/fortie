<?php namespace Wetcat\Fortie\Providers\Contracts;

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
use Wetcat\Fortie\Providers\Contracts\Filter;

class Provider extends ProviderBase {

  protected $attributes = [
    'Url',
    'UrlTaxReductionList',
    'Active',
    'AdministrationFee',
    'Comments',
    'Continuous',
    'ContractDate',
    'ContractLength',
    'ContributionPercent',
    'ContributionValue',
    'CostCenter',
    'Currency',
    'CustomerName',
    'CustomerNumber',
    'DocumentNumber',
    'EmailInformation',
    'ExternalInvoiceReference1',
    'ExternalInvoiceReference2',
    'Freight',
    'Gross',
    'HouseWork',
    'InvoiceDiscount',
    'InvoiceInterval',
    'InvoiceRows',
    'InvoicesRemaining',
    'Language',
    'LastInvoiceDate',
    'Net',
    'OurReference',
    'PeriodEnd',
    'PeriodStart',
    'PriceList',
    'Project',
    'Remarks',
    'TaxReduction',
    'TemplateName',
    'TemplateNumber',
    'TermsOfDelivery',
    'TermsOfPayment',
    'Total',
    'TotalToPay',
    'TotalVAT',
    'VATIncluded',
    'WayOfDelivery',
    'YourOrderNumber',
    // Email information
    'EmailAddressTo',
    'EmailAddressCC',
    'EmailAddressBCC',
    'EmailSubject',
    'EmailBody',
    // Invoice row
    'AccountNumber',
    'ArticleNumber',
    'ContributionPercent',
    'ContributionValue',
    'CostCenter',
    'DeliveredQuantity',
    'Description',
    'Discount',
    'DiscountType',
    'HouseWork',
    'Price',
    'Project',
    'Total',
    'Unit',
    'VAT',
  ];


  protected $writeable = [
    'Active',
    'AdministrationFee',
    'Comments',
    'Continuous',
    'ContractDate',
    'ContractLength',
    'CostCenter',
    'Currency',
    'CustomerName',
    'CustomerNumber',
    'DocumentNumber',
    'EmailInformation',
    'ExternalInvoiceReference1',
    'ExternalInvoiceReference2',
    'Freight',
    'InvoiceDiscount',
    'InvoiceInterval',
    'InvoiceRows',
    'Language',
    'OurReference',
    'PeriodEnd',
    'PeriodStart',
    'PriceList',
    'Project',
    'Remarks',
    'TemplateNumber',
    'TermsOfDelivery',
    'TermsOfPayment',
    'VATIncluded',
    'WayOfDelivery',
    'YourOrderNumber',
    // Email information
    'EmailAddressTo',
    'EmailAddressCC',
    'EmailAddressBCC',
    'EmailSubject',
    'EmailBody',
    // Invoice row
    'CostCenter',
    'DeliveredQuantity',
    'Description',
    'Discount',
    'DiscountType',
    'HouseWork',
    'Price',
    'Project',
    'Unit',
    'VAT',
  ];


  protected $required_create = [
    'ContractLength',
    'CustomerNumber',
    'InvoiceInterval',
    'InvoiceRows',
    'PeriodEnd',
    'PeriodStart',
    // 'Total',
  ];


  protected $required_update = [
    'InvoiceRows'
  ];


  /**
   * Override the REST path
   */
  protected $basePath = 'contracts';


  /**
   * Retrieves a list of contracts.
   *
   * @return array
   */
  public function all ($filter = null)
  {
    $req = new FortieRequest();
    $req->method('GET');
    $req->path($this->basePath);

    if (!is_null($filter)) {
      $req->filter($filter);
    }

    return $this->send($req->build());
  }


  /**
   * Retrieves a single contract.
   *
   * @param $id
   * @return array
   */
  public function find ($id)
  {
    $req = new FortieRequest();
    $req->method('GET');
    $req->path($this->basePath);
    $req->path($id);

    return $this->send($req->build());
  }


  /**
   * Creates a contract.
   *
   * @param array   $params
   * @return array
   */
  public function create (array $data)
  {
    $req = new FortieRequest();
    $req->method('POST');
    $req->path($this->basePath);
    $req->wrapper('Contract');
    $req->data($data);
    $req->setRequired($this->required_create);

    return $this->send($req->build());
  }


  /**
   * Updates a contract.
   *
   * @param array   $params
   * @return array
   */
  public function update ($id, array $data)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($id);
    $req->wrapper('Contract');
    $req->setRequired($this->required_update);
    $req->data($data);

    return $this->send($req->build());
  }


  /**
   * Set a contract as finished.
   */
  public function finish ($id)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($id)->path('finish');

    return $this->send($req->build());
  }


  /**
   * Create invoice from contract.
   */
  public function create_invoice ($id)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($id);
    $req->path('createinvoice');

    return $this->send($req->build());
  }


  /**
   * Increases the invoice count without creating an invoice.
   */
  public function increase_invoice_count ($id)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($id);
    $req->path('increaseinvoicecount');

    return $this->send($req->build());
  }

}
