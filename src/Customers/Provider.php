<?php namespace Wetcat\Fortie\Customers;


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
  public function listAllCustomers ()
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
  public function retrieveCustomer ($id)
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
  public function createCustomer (array $params)
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
  public function updateCustomer ($id, array $params)
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
  public function deleteCustomer ($id)
  {
    throw new Exception('Not implemented');
  }


}