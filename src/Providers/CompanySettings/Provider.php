<?php namespace Wetcat\Fortie\Providers\CompanySettings;

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


  protected $required_create = [
  ];


  protected $required_update = [
  ];


  /**
   * Override the REST path
   */
  protected $basePath = 'settings/company';


  /**
   * Retrieves a list of articles. The articles are returned sorted by 
   * article number with the lowest number appearing first.
   *
   * @return array
   */
  public function all ()
  {
    $req = new FortieRequest();
    $req->method('GET');
    $req->path($this->basePath);

    return $this->send($req->build());
  }

}
