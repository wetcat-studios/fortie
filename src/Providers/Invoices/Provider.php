<?php namespace Wetcat\Fortie\Providers\Invoices;

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
    'AdministrationFee',
    'AdministrationFeeVAT',
    'Address1',
    'Address2',
    'Balance',
    'BasisTaxReduction',
    'Booked',
    'Cancelled',
    'Credit',
    'CreditInvoiceReference',
    'City',
    'Comments',
    'ContractReference',
    'ContributionPercent',
    'ContributionValue',
    'Country',
    'CostCenter',
    'Currency',
    'CurrencyRate',
    'CurrencyUnit',
    'CustomerName',
    'CustomerNumber',
    'DeliveryAddress1',
    'DeliveryAddress2',
    'DeliveryCity',
    'DeliveryCountry',
    'DeliveryDate',
    'DeliveryName',
    'DeliveryZipCode',
    'DocumentNumber',
    'DueDate',
    'EDIInformation',
    'EmailInformation',
    'ExternalInvoiceReference1',
    'ExternalInvoiceReference',
    'Freight',
    'FreightVAT',
    'Gross',
    'HouseWork',
    'InvoiceDate',
    'InvoicePeriodStart',
    'InvoicePeriodEnd',
    'InvoiceRows',
    'InvoiceType',
    'Language',
    'LastRemindDate',
    'Net',
    'NotCompleted',
    'NoxFinans',
    'OCR',
    'OfferReference',
    'OrderReference',
    'OrganisationNumber',
    'OurReference',
    'Phone1',
    'Phone2',
    'PriceList',
    'PrintTemplate',
    'Project',
    'Remarks',
    'Reminders',
    'RoundOff',
    'Sent',
    'TaxReduction',
    'TermsOfDelivery',
    'TermsOfPayment',
    'Total',
    'TotalVAT',
    'VATIncluded',
    'VoucherNumber',
    'VoucherSeries',
    'VoucherYear',
    'WayOfDelivery',
    'YourOrderNumber',
    'YourReference',
    'ZipCode',
    // EDI
    'EDIGlobalLocationNumber',
    'EDIGlobalLocationNumberDelivery',
    'EDIInvoiceExtra1',
    'EDIInvoiceExtra2',
    'EDIOurElectronicReference',
    'EDIYourElectronicReference',
    // Email
    'EmailAddressTo',
    'EmailAddressCC',
    'EmailAddressBCC',
    'EmailSubject',
    'EmailBody',
    // Rows
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
    'HouseWorkHoursToReport',
    'HouseWorkType',
    'Price',
    'PriceExcludingVAT',
    'Project',
    'Total',
    'TotalExcludingVAT',
    'Unit',
    'VAT',
  ];

  protected $writeable = [
    'AdministrationFee',
    'Address1',
    'Address2',
    'CreditInvoiceReference',
    'City',
    'Comments',
    'Country',
    'CostCenter',
    'Currency',
    'CurrencyRate',
    'CurrencyUnit',
    'CustomerName',
    'CustomerNumber',
    'DeliveryAddress1',
    'DeliveryAddress2',
    'DeliveryCity',
    'DeliveryCountry',
    'DeliveryDate',
    'DeliveryName',
    'DeliveryZipCode',
    'DocumentNumber',
    'DueDate',
    'EDIInformation',
    'EmailInformation',
    'ExternalInvoiceReference1',
    'ExternalInvoiceReference',
    'Freight',
    'InvoiceDate',
    'InvoiceRows',
    'InvoiceType',
    'Language',
    'NotCompleted',
    'OCR',
    'OurReference',
    'Phone1',
    'Phone2',
    'PriceList',
    'PrintTemplate',
    'Project',
    'Remarks',
    'TermsOfDelivery',
    'TermsOfPayment',
    'VATIncluded',
    'WayOfDelivery',
    'YourOrderNumber',
    'YourReference',
    'ZipCode',
    // EDI
    'EDIGlobalLocationNumber',
    'EDIGlobalLocationNumberDelivery',
    'EDIInvoiceExtra1',
    'EDIInvoiceExtra2',
    'EDIOurElectronicReference',
    'EDIYourElectronicReference',
    // Email
    'EmailAddressTo',
    'EmailAddressCC',
    'EmailAddressBCC',
    'EmailSubject',
    'EmailBody',
    // Rows
    'AccountNumber',
    'ArticleNumber',
    'CostCenter',
    'DeliveredQuantity',
    'Description',
    'Discount',
    'DiscountType',
    'HouseWork',
    'HouseWorkHoursToReport',
    'HouseWorkType',
    'Price',
    'Project',
    'Unit',
    'VAT',
  ];

  protected $required = [
    'CustomerNumber', 
  ];

  /**
   * Override the REST path
   */
  protected $path = 'invoices';


  /**
   * Retrieves a list of invoices. The invoices are returned sorted by 
   * document number with the lowest number appearing first.
   *
   * @return array
   */
  public function all ()
  {
    return $this->sendRequest('GET');
  }


  /**
   * Retrieves the details of an invoice. You need to supply the unique 
   * document number that was returned when the invoice was created or 
   * retrieved from the list of invoices.
   *
   * @param $id
   * @return array
   */
  public function find ($id)
  {
    return $this->sendRequest('GET', $id);
  }


  /**
   * The created invoice will be returned if everything succeeded, if 
   * there was any problems an error will be returned.
   *
   * You must specify a customer to create an invoice. It’s possible 
   * to create an invoice without rows, although we encourage you to 
   * add them if you can.
   *
   * Predefined values will be used for properties where it applies, 
   * the values can be changed in the settings for the Fortnox account. 
   * Predefined values will always be overwritten by values provided 
   * through the API.
   *
   * @param array   $params
   * @return array
   */
  public function create (array $params)
  {
    return $this->sendRequest('POST', null, 'Invoice', $params);
  }


  /**
   * The updated invoice will be returned if everything succeeded, if
   * there was any problems an error will be returned.
   *
   * You need to supply the document number of the invoice that you 
   * want to update.
   *
   * Note that when updating rows you’ll need to provide all the rows
   * of the invoice, only providing the updates will overwrite the 
   * current rows resulting in the old ones being removed.
   *
   * @param array   $params
   * @return array
   */
  public function update ($id, array $params)
  {
    return $this->sendRequest('PUT', $id, 'Invoice', $params);
  }


  /**
   * Bookkeeps an invoice
   */
  public function bookkeep ($id)
  {
    return $this->sendRequest('PUT', [$id, 'bookkeep']);
  }


  /**
   * Cancels an invoice
   */
  public function cancel ($id)
  {
    return $this->sendRequest('PUT', [$id, 'cancel']);
  }


  /**
   * Creates a credit invoice from the provided invoice. The created 
   * credit invoice will be referenced in the property 
   * CreditInvoiceReference.
   */
  public function credit ($id)
  {
    return $this->sendRequest('PUT', [$id, 'credit']);
  }


  /**
   * Sends an e-mail to the customer with an attached PDF document 
   * of the invoice. You can use the properties in the 
   * EmailInformation to customize the e-mail message on each 
   * invoice.
   */
  public function email ($id)
  {
    return $this->sendRequest('PUT', [$id, 'email']);
  }


  /**
   * This action returns a PDF document with the current template
   * that is used by the specific document. Note that this action
   * also sets the property Sent as true.
   */
  public function write ($id)
  {
    return $this->sendRequest('GET', [$id, 'print']);
  }


  /**
   * This action returns a PDF document with the current reminder
   * template that is used by the specific document. Note that
   * this action also sets the property Sent as true.
   */
  public function reminder ($id)
  {
    return $this->sendRequest('GET', [$id, 'printreminder']);
  }


  /**
   * This action is used to set the field Sent as true from an 
   * external system without generating a PDF.
   */
  public function external ($id)
  {
    return $this->sendRequest('GET', [$id, 'externalprint']);
  }


  /**
   * This action returns a PDF document with the current template
   * that is used by the specific document. Apart from the action
   * print, this action doesn’t set the property Sent as true.
   */
  public function preview ($id)
  {
    return $this->sendRequest('GET', [$id, 'credit']);
  }

}