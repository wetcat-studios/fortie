<?php

namespace Wetcat\Fortie\Providers\Customers;

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
use Wetcat\Fortie\Traits\CountTrait;
use Wetcat\Fortie\Traits\CreateTrait;
use Wetcat\Fortie\Traits\DeleteTrait;
use Wetcat\Fortie\Traits\FetchTrait;
use Wetcat\Fortie\Traits\FindTrait;
use Wetcat\Fortie\Traits\UpdateTrait;

class Provider extends ProviderBase
{
    use CountTrait,
      CreateTrait,
      DeleteTrait,
      FetchTrait,
      FindTrait,
      UpdateTrait;

    protected $wrapper = 'Customer';

    protected $wrapperGroup = 'Customers';

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
     * The possible values for filtering the customers.
     *
     * @var array
     */
    protected $available_filters = [
        'active',
        'inactive',
    ];

    /**
     * Override the REST path.
     */
    protected $basePath = 'customers';
}
