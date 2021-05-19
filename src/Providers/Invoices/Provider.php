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

  protected $wrapper = 'Invoice';
  protected $wrapperGroup = 'Invoices';

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
    'TaxReductionType',
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
    'TaxReductionType',
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
   * The possible values for filtering.
   *
   * @var array
   */
  protected $available_filters = [
    'cancelled',
    'fullypaid',
    'unpaid',
    'unpaidoverdue',
    'unbooked',
  ];


  /**
   * Override the REST path
   */
  protected $basePath = 'invoices';


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
    $req->method('GET');
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
    $req->path($this->basePath)->path($id)->path('preview');

    return $this->send($req->build());
  }

}
