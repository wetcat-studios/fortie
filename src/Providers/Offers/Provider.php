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

use Wetcat\Fortie\Providers\ProviderBase;


class Provider extends ProviderBase {


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

  protected $required = [
  ];

  /**
   * Override the REST path
   */
  protected $path = 'offers';


  /**
   * Retrieves a list of offers.
   *
   * @return array
   */
  public function all ()
  {
    return $this->sendRequest('GET');
  }


  /**
   * Retrieves a single offer.
   *
   * @param $id
   * @return array
   */
  public function find ($id)
  {
    return $this->sendRequest('GET', $id);
  }


  /**
   * Creates an offer.
   *
   * @param array   $params
   * @return array
   */
  public function create (array $params)
  {
    return $this->sendRequest('POST', null, 'Offer', $params);
  }


  /**
   * Updates an offer.
   *
   * @param array   $params
   * @return array
   */
  public function update ($id, array $params)
  {
    return $this->sendRequest('PUT', $id, 'Offer', $params);
  }


  /**
   * Creates an order from the offer.
   */
  public function createorder ($id)
  {
    return $this->sendRequest('PUT', [$id, 'createorder']);
  }


  /**
   * Cancels an offer.
   */
  public function cancel ($id)
  {
    return $this->sendRequest('PUT', [$id, 'cancel']);
  }


  /**
   * Sends an e-mail to the customer with an attached PDF document of the 
   * offer. You can use the fieldEmailInformation to customize the e-mail
   * message on each offer.
   */
  public function email ($id)
  {
    return $this->sendRequest('PUT', [$id, 'email']);
  }


  /**
   * This action returns a PDF document with the current template that is 
   * used by the specific document. Note that this action also sets the 
   * field Sent as true.
   */
  public function pdf ($id)
  {
    return $this->sendRequest('GET', [$id, 'print']);
  }


  /**
   * This action is used to set the field Sent as true from an external 
   * system without generating a PDF.
   */
  public function external ($id)
  {
    return $this->sendRequest('PUT', [$id, 'externalprint']);
  }


  /**
   * This action returns a PDF document with the current template that 
   * is used by the specific document. Apart from the action print, this 
   * action doesn’t set the field Sent as true.
   */
  public function preview ($id)
  {
    return $this->sendRequest('GET', [$id, 'preview']);
  }

}