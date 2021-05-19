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

use Wetcat\Fortie\FortieRequest;
use Wetcat\Fortie\Providers\ProviderBase;
use Wetcat\Fortie\Traits\CountTrait;
use Wetcat\Fortie\Traits\CreateTrait;
use Wetcat\Fortie\Traits\FetchTrait;
use Wetcat\Fortie\Traits\FindTrait;
use Wetcat\Fortie\Traits\UpdateTrait;

class Provider extends ProviderBase {

  use CountTrait,
      CreateTrait,
      FetchTrait,
      FindTrait,
      UpdateTrait;

  protected $wrapper = 'Contract';
  protected $wrapperGroup = 'Contracts';

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
    'TaxReductionType',
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
    'TaxReductionType',
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
   * The possible values for filtering.
   *
   * @var array
   */
  protected $available_filters = [
    'active',
    'inactive',
    'finished'
  ];


  /**
   * Override the REST path
   */
  protected $basePath = 'contracts';


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
