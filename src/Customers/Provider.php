<?php namespace Wetcat\Fortie\Customers;

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

use Wetcat\Fortie\ProviderBase;


class Provider extends ProviderBase {


  protected $attributes = [
    'Url',
    'Address1',
    'Address2',
    'City',
    'Country',
    'Comments',
    'Currency',
    'CostCenter',
    'CountryCode',
    'CustomerNumber',
    'DefaultDeliveryTypes',
    'DefaultTemplates',
    'DeliveryAddress1',
    'DeliveryAddress2',
    'DeliveryCity',
    'DeliveryCountry',
    'DeliveryCountryCode',
    'DeliveryFax',
    'DeliveryName',
    'DeliveryPhone1',
    'DeliveryPhone2',
    'DeliveryZipCode',
    'Email',
    'EmailInvoice',
    'EmailInvoiceBCC',
    'EmailInvoiceCC',
    'EmailOffer',
    'EmailOfferBCC',
    'EmailOfferCC',
    'EmailOrder',
    'EmailOrderBCC',
    'EmailOrderCC',
    'Fax',
    'InvoiceAdministrationFee',
    'InvoiceDiscount',
    'InvoiceFreight',
    'InvoiceRemark',
    'Name',
    'OrganisationNumber',
    'OurReference',
    'Phone1',
    'Phone2',
    'PriceList',
    'Project',
    'SalesAccount',
    'ShowPriceVATIncluded',
    'TermsOfDelivery',
    'TermsOfPayment',
    'Type',
    'VATNumber',
    'VATType',
    'VisitingAddress',
    'VisitingCity',
    'VisitingCountry',
    'VisitingCountryCode',
    'VisitingZipCode',
    'WWW',
    'WayOfDelivery',
    'YourReference',
    'ZipCode',
    // Delivery
    'Invoice',
    'Order',
    'Offer',
    // Default templates
    'Order',
    'Offer',
    'Invoice',
    'CashInvoice',
  ];

  protected $writeable = [
    'Address1',
    'Address2',
    'City',
    'Comments',
    'Currency',
    'CostCenter',
    'CountryCode',
    'CustomerNumber',
    'DefaultDeliveryTypes',
    'DefaultTemplates',
    'DeliveryAddress1',
    'DeliveryAddress2',
    'DeliveryCity',
    'DeliveryCountryCode',
    'DeliveryFax',
    'DeliveryName',
    'DeliveryPhone1',
    'DeliveryPhone2',
    'DeliveryZipCode',
    'Email',
    'EmailInvoice',
    'EmailInvoiceBCC',
    'EmailInvoiceCC',
    'EmailOffer',
    'EmailOfferBCC',
    'EmailOfferCC',
    'EmailOrder',
    'EmailOrderBCC',
    'EmailOrderCC',
    'Fax',
    'InvoiceAdministrationFee',
    'InvoiceDiscount',
    'InvoiceFreight',
    'InvoiceRemark',
    'Name',
    'OrganisationNumber',
    'OurReference',
    'Phone1',
    'Phone2',
    'PriceList',
    'Project',
    'SalesAccount',
    'ShowPriceVATIncluded',
    'TermsOfDelivery',
    'TermsOfPayment',
    'Type',
    'VATNumber',
    'VATType',
    'VisitingAddress',
    'VisitingCity',
    'VisitingCountryCode',
    'VisitingZipCode',
    'WWW',
    'WayOfDelivery',
    'YourReference',
    'ZipCode',
    // Delivery
    'Invoice',
    'Order',
    'Offer',
    // Default templates
    'Order',
    'Offer',
    'Invoice',
    'CashInvoice',
  ];

  protected $required = [
    'Name',
  ];

  /**
   * Override the REST path
   */
  protected $path = 'customers';


  /**
   * Retrieves a list of customers. The customers are returned sorted 
   * by customer number with the lowest number appearing first.
   *
   * @return array
   */
  public function all ()
  {
    return $this->sendRequest('GET');
  }


  /**
   * Retrieves the details of a customer. You need to supply the 
   * unique customer number that was returned when the customer was
   * created or retrieved from the list of customers.
   *
   * @param $id
   * @return array
   */
  public function find ($id)
  {
    return $this->sendRequest('GET', $id);
  }


  /**
   * The created customer will be returned if everything succeeded,
   * if there was any problems an error will be returned.
   *
   * @param array   $params
   * @return array
   */
  public function create (array $params)
  {
    return $this->sendRequest('POST', null, 'Customer', $params);
  }


  /**
   * The updated customer will be returned if everything succeeded, 
   * if there was any problems an error will be returned.
   *
   * You need to supply the unique customer number of the customer 
   * that you want to update.
   *
   * Only the properties provided in the request body will be updated,
   * properties not provided will left unchanged.
   *
   * @param array   $params
   * @return array
   */
  public function update ($id, array $params)
  {
    return $this->sendRequest('PUT', $id, 'Customer', $params);
  }


  /**
   * Deletes the customer permanently. If everything succeeded the
   * response will be of the type “204 – No content” and the response
   * body will be empty. If there was any problems an error will be
   * returned.
   *
   * You need to supply the unique customer number of the customer
   * that you want to delete.
   */
  public function delete ($id)
  {
    throw new Exception('Not implemented');
  }


}