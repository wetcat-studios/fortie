<?php namespace Wetcat\Fortie\CompanySettings;


use Wetcat\Fortie\ProviderBase;


class Provider extends ProviderBase {

  protected $attributes = [
    'Url',
    'Address',
    'BG',
    'BIC',
    'BranchCode',
    'City',
    'ContactFirstName',
    'ContactLastName',
    'Country',
    'CountryCode',
    'DatabaseNumber',
    'Domicile',
    'Email',
    'Fax',
    'IBAN',
    'Name',
    'OrganisationNumber',
    'PG',
    'Phone1',
    'Phone2',
    'TaxEnabled',
    'VATNumber',
    'VisitAddress',
    'VisitCity',
    'VisitCountry',
    'VisitCountryCode',
    'VisitName',
    'VisitZipCode',
    'WWW',
    'ZipCode',
  ];

  protected $writeable = [
  ];

  protected $required = [
  ];

  /**
   * Override the REST path
   */
  protected $path = 'settings/company';


  /**
   * Retrieves a list of articles. The articles are returned sorted by 
   * article number with the lowest number appearing first.
   *
   * @return array
   */
  public function listCompanySettings ()
  {
    return $this->sendRequest('GET');
  }

}










