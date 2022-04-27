<?php namespace Wetcat\Fortie\Providers\Suppliers;

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
use Wetcat\Fortie\Traits\DeleteTrait;
use Wetcat\Fortie\Traits\FetchTrait;
use Wetcat\Fortie\Traits\FindTrait;
use Wetcat\Fortie\Traits\UpdateTrait;

class Provider extends ProviderBase {

  use CountTrait,
      CreateTrait,
      DeleteTrait,
      FetchTrait,
      FindTrait,
      UpdateTrait;


  protected $wrapper = 'Supplier';
  protected $wrapperGroup = 'Suppliers';

  protected $attributes = [
    'Url',
    'Active',
    'Address1',
    'Address2',
    'Bank',
    'BankAccountNumber',
    'BG',
    'BIC',
    'BranchCode',
    'City',
    'ClearingNumber',
    'Comments',
    'CostCenter',
    'Country',
    'CountryCode',
    'Currency',
    'DisablePaymentFile',
    'Email',
    'Fax',
    'IBAN',
    'Name',
    'OrganisationNumber',
    'OurReference',
    'OurCustomerNumber',
    'PG',
    'Phone1',
    'Phone2',
    'PreDefinedAccount',
    'Project',
    'SupplierNumber',
    'TermsOfPayment',
    'VATNumber',
    'VATType',
    'VisitingAddress',
    'VisitingCity',
    'VisitingCountry',
    'VisitingCountryCode',
    'VisitingZipCode',
    'WorkPlace',
    'WWW',
    'YourReference',
    'ZipCode',
  ];


  protected $writeable = [
    'Url',
    'Active',
    'Address1',
    'Address2',
    'Bank',
    'BankAccountNumber',
    'BG',
    'BIC',
    'BranchCode',
    'City',
    'ClearingNumber',
    'Comments',
    'CostCenter',
    'Country',
    'CountryCode',
    'Currency',
    'DisablePaymentFile',
    'Email',
    'Fax',
    'IBAN',
    'Name',
    'OrganisationNumber',
    'OurReference',
    'OurCustomerNumber',
    'PG',
    'Phone1',
    'Phone2',
    'PreDefinedAccount',
    'Project',
    'SupplierNumber',
    'TermsOfPayment',
    'VATNumber',
    'VATType',
    'VisitingAddress',
    'VisitingCity',
    'VisitingCountry',
    'VisitingCountryCode',
    'VisitingZipCode',
    'WorkPlace',
    'WWW',
    'YourReference',
    'ZipCode',
  ];


  protected $required_create = [
    'Name',
  ];


  protected $required_update = [
  ];


  /**
   * Override the REST path
   */
  protected $basePath = 'suppliers';
}
