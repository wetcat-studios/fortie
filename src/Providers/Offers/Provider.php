<?php namespace Wetcat\Fortie\Providers\Offers;

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

  protected $wrapper = 'Offer';
  protected $wrapperGroup = 'Offers';

  protected $attributes = [
    'Url',
    'AdministrationFee',
    'AdministrationFeeVAT',
    'Address1',
    'Address2',
    'BasisTaxReduction',
    'Cancelled',
    'City',
    'Comments',
    'ContributionPercent',
    'ContributionValue',
    'CopyRemarks',
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
    'EmailInformation',
    'ExpireDate',
    'Freight',
    'FreightVAT',
    'Gross',
    'HouseWork',
    'OrderReference',
    'Net',
    'Completed',
    'OfferDate',
    'OrderReference',
    'OrganisationNumber',
    'OurReference',
    'Phone1',
    'Phone2',
    'PriceList',
    'PrintTemplate',
    'Project',
    'Remarks',
    'RoundOff',
    'OfferRows',
    'Sent',
    'TaxReduction',
    'TaxReductionType',
    'TermsOfDelivery',
    'TermsOfPayment',
    'Total',
    'TotalVat',
    'VatIncluded',
    'WayOfDelivery',
    'YourReference',
    'ZipCode',
    // Email
    'EmailAddressTo',
    'EmailAddressCC',
    'EmailAddressBCC',
    'EmailSubject',
    'EmailBody',
    // Offers
    'AccountNumber',
    'ArticleNumber',
    'ContributionPercent',
    'ContributionValue',
    'CostCenter',
    'Description',
    'Discount',
    'DiscountType',
    'HouseWork',
    'HouseWorkHoursToReport',
    'HouseWorkType',
    'Price',
    'Project',
    'Quantity',
    'Total',
    'Unit',
    'VAT',
  ];


  protected $writeable = [
    'AdministrationFee',
    'Address1',
    'Address2',
    'City',
    'Comments',
    'CopyRemarks',
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
    'EmailInformation',
    'ExpireDate',
    'Freight',
    'Completed',
    'OfferDate',
    'OrganisationNumber',
    'OurReference',
    'Phone1',
    'Phone2',
    'PriceList',
    'PrintTemplate',
    'Project',
    'Remarks',
    'OfferRows',
    'TaxReductionType',
    'TermsOfDelivery',
    'TermsOfPayment',
    'VatIncluded',
    'WayOfDelivery',
    'YourReference',
    'ZipCode',
    // Email
    'EmailAddressTo',
    'EmailAddressCC',
    'EmailAddressBCC',
    'EmailSubject',
    'EmailBody',
    // Offers
    'AccountNumber',
    'ArticleNumber',
    'CostCenter',
    'Description',
    'Discount',
    'DiscountType',
    'HouseWork',
    'HouseWorkHoursToReport',
    'HouseWorkType',
    'Price',
    'Project',
    'Quantity',
    'Unit',
    'VAT',
  ];


  protected $required_create = [
  ];


  protected $required_update = [
  ];


  /**
   * The possible values for filtering.
   *
   * @var array
   */
  protected $available_filters = [
    'cancelled',
    'expired',
    'ordercreated',
    'ordernotcreated',
  ];


  /**
   * Override the REST path
   */
  protected $basePath = 'offers';


  /**
   * Creates an order from the offer.
   */
  public function createOrder ($id)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($id)->path('createorder');

    return $this->send($req->build());
  }


  /**
   * Cancels an offer.
   */
  public function cancel ($id)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($id)->path('cancel');

    return $this->send($req->build());
  }


  /**
   * Sends an e-mail to the customer with an attached PDF document of the 
   * offer. You can use the fieldEmailInformation to customize the e-mail
   * message on each offer.
   */
  public function email ($id)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($id)->path('email');

    return $this->send($req->build());
  }


  /**
   * This action returns a PDF document with the current template that is 
   * used by the specific document. Note that this action also sets the 
   * field Sent as true.
   */
  public function pdf ($id)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($id)->path('print');

    return $this->send($req->build());
  }


  /**
   * This action is used to set the field Sent as true from an external 
   * system without generating a PDF.
   */
  public function externalPrint ($id)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($id)->path('externalprint');

    return $this->send($req->build());
  }


  /**
   * This action returns a PDF document with the current template that 
   * is used by the specific document. Apart from the action print, this 
   * action doesn’t set the field Sent as true.
   */
  public function preview ($id)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($id)->path('preview');

    return $this->send($req->build());
  }

}
