<?php

namespace Wetcat\Fortie\Providers\Suppliers;

/*

   Copyright The Fortie authors

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

class Provider extends ProviderBase
{
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
     * Override the REST path.
     */
    protected $basePath = 'suppliers';

    /**
     * Retrieves a list of suppliers.
     *
     * @param null|mixed $page
     *
     * @return array
     */
    public function all($page = null)
    {
        $req = new FortieRequest();
        $req->method('GET');
        $req->path($this->basePath);

        if (! is_null($page)) {
            $req->param('page', $page);
        }

        return $this->send($req->build());
    }

    /**
     * Retrieves a single supplier.
     *
     * @param $supplierNumber
     *
     * @return array
     */
    public function find($supplierNumber)
    {
        $req = new FortieRequest();
        $req->method('GET');
        $req->path($this->basePath)->path($supplierNumber);

        return $this->send($req->build());
    }

    /**
     * Creates a supplier.
     *
     * @param array $data
     *
     * @return array
     */
    public function create(array $data)
    {
        $req = new FortieRequest();
        $req->method('POST');
        $req->path($this->basePath);
        $req->wrapper('Supplier');
        $req->setRequired($this->required_create);
        $req->data($data);

        return $this->send($req->build());
    }

    /**
     * Updates a supplier.
     *
     * @param array $data
     * @param mixed $id
     *
     * @return array
     */
    public function update($id, array $data)
    {
        $req = new FortieRequest();
        $req->method('PUT');
        $req->path($this->basePath)->path($id);
        $req->wrapper('Supplier');
        $req->setRequired($this->required_update);
        $req->data($data);

        return $this->send($req->build());
    }

    /**
     * Removes a supplier.
     *
     * @param mixed $supplierNumber
     */
    public function delete($supplierNumber)
    {
        $req = new FortieRequest();
        $req->method('DELETE');
        $req->path($this->basePath)->path($supplierNumber);

        return $this->send($req->build());
    }
}
