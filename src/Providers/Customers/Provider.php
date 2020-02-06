<?php namespace Wetcat\Fortie\Providers\Customers;

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
    'GLN',
    'GLNDelivery',
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
    'GLN',
    'GLNDelivery',
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


  protected $required_create = [
    'Name',
  ];


  protected $required_update = [
    // 'CustomerNumber',
  ];


  /**
   * Override the REST path
   */
  protected $basePath = 'customers';


  /**
   * Retrieves a list of customers. The customers are returned sorted 
   * by customer number with the lowest number appearing first.
   *
   * @return array
   */
  public function all ($page = null)
  {
    $req = new FortieRequest();
    $req->method('GET');
    $req->path($this->basePath);

    if (!is_null($page)) {  
      $req->param('page', $page);
    }

    return $this->send($req->build());
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
    $req = new FortieRequest();
    $req->method('GET');
    $req->path($this->basePath)->path($id);

    return $this->send($req->build());
  }


  /**
   * The created customer will be returned if everything succeeded,
   * if there was any problems an error will be returned.
   *
   * @param array   $data
   * @return array
   */
  public function create (array $data)
  {
    $req = new FortieRequest();
    $req->method('POST');
    $req->path($this->basePath);
    $req->wrapper('Customer');
    $req->setRequired($this->required_create);
    $req->data($data);

    return $this->send($req->build());
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
   * @param array   $data
   * @return array
   */
  public function update ($id, array $data)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($id);
    $req->wrapper('Customer');
    $req->setRequired($this->required_update);
    $req->data($data);

    return $this->send($req->build());
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
    $req = new FortieRequest();
    $req->method('DELETE');
    $req->path($this->basePath);
    $req->path($id);

    return $this->send($req->build());
  }

}
