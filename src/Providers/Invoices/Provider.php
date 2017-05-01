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
use Wetcat\Fortie\FortieRequest;

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


  protected $required_create = [
    'CustomerNumber',
    'InvoiceRows' 
  ];


  protected $required_update = [
    'CustomerNumber', 
  ];


  /**
   * Override the REST path
   */
  protected $basePath = 'invoices';


  /**
   * Retrieves a list of invoices. The invoices are returned sorted by 
   * document number with the lowest number appearing first.
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
   * Retrieves the details of an invoice. You need to supply the unique 
   * document number that was returned when the invoice was created or 
   * retrieved from the list of invoices.
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
   * @param array   $data
   * @return array
   */
  public function create (array $data)
  {
    $req = new FortieRequest();
    $req->method('POST');
    $req->path($this->basePath);
    $req->wrapper('Invoice');
    $req->setRequired($this->required_create);
    $req->data($data);

    return $this->send($req->build());
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
  public function update ($id, array $data)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($id);
    $req->wrapper('Invoice');
    $req->setRequired($this->required_update);
    $req->data($data);

    return $this->send($req->build());
  }


  /**
   * Bookkeeps an invoice
   */
  public function bookkeep ($id)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($id)->path('bookkeep');

    return $this->send($req->build());
  }


  /**
   * Cancels an invoice
   */
  public function cancel ($id)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($id)->path('cancel');

    return $this->send($req->build());
  }


  /**
   * Creates a credit invoice from the provided invoice. The created 
   * credit invoice will be referenced in the property 
   * CreditInvoiceReference.
   */
  public function credit ($id)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($id)->path('credit');

    return $this->send($req->build());
  }


  /**
   * Sends an e-mail to the customer with an attached PDF document 
   * of the invoice. You can use the properties in the 
   * EmailInformation to customize the e-mail message on each 
   * invoice.
   */
  public function email ($id)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($id)->path('email');

    return $this->send($req->build());
  }


  /**
   * This action returns a PDF document with the current template
   * that is used by the specific document. Note that this action
   * also sets the property Sent as true.
   */
  public function write ($id)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($id)->path('print');

    return $this->send($req->build());
  }


  /**
   * This action returns a PDF document with the current reminder
   * template that is used by the specific document. Note that
   * this action also sets the property Sent as true.
   */
  public function reminder ($id)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($id)->path('printreminder');

    return $this->send($req->build());
  }


  /**
   * This action is used to set the field Sent as true from an 
   * external system without generating a PDF.
   */
  public function external ($id)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($id)->path('externalprint');

    return $this->send($req->build());
  }


  /**
   * This action returns a PDF document with the current template
   * that is used by the specific document. Apart from the action
   * print, this action doesn’t set the property Sent as true.
   */
  public function preview ($id)
  {
    $req = new FortieRequest();
    $req->method('GET');
    $req->path($this->basePath)->path($id)->path('credit');

    return $this->send($req->build());
  }

}
