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

  protected $required = [
  ];

  /**
   * Override the REST path
   */
  protected $path = 'contracts';


  /**
   * Retrieves a list of contracts.
   *
   * @return array
   */
  public function all ()
  {
    return $this->sendRequest('GET');
  }


  /**
   * Retrieves a single contract.
   *
   * @param $id
   * @return array
   */
  public function find ($id)
  {
    return $this->sendRequest('GET', $id);
  }


  /**
   * Creates a contract.
   *
   * @param array   $params
   * @return array
   */
  public function create (array $params)
  {
    return $this->sendRequest('POST', null, 'Contract', $params);
  }


  /**
   * Updates a contract.
   *
   * @param array   $params
   * @return array
   */
  public function update ($id, array $params)
  {
    return $this->sendRequest('PUT', $id, 'Contract', $params);
  }


  /**
   * Set a contract as finished.
   */
  public function finish ($id)
  {
    return $this->sendRequest('PUT', [$id, 'finish']);
  }


  /**
   * Create invoice from contract.
   */
  public function createinvoice ($id)
  {
    return $this->sendRequest('PUT', [$id, 'createinvoice']);
  }


  /**
   * Increases the invoice count without creating an invoice.
   */
  public function increaseinvoicecount ($id)
  {
    return $this->sendRequest('PUT', [$id, 'increaseinvoicecount']);
  }

}