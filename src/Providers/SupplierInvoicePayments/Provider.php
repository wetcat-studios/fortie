<?php

namespace Wetcat\Fortie\Providers\SupplierInvoicePayments;

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

class Provider extends ProviderBase
{
    protected $attributes = [
        'Url',
        'Amount',
        'AmountCurrency',
        'Booked',
        'Currency',
        'CurrencyRate',
        'CurrencyUnit',
        'Information',
        'InvoiceNumber',
        'InvoiceDueDate',
        'InvoiceOCR',
        'InvoiceSupplierName',
        'InvoiceSupplierNumber',
        'InvoiceTotal',
        'ModeOfPayment',
        'Number',
        'PaymentDate',
        'Source',
        'VoucherNumber',
        'VoucherSeries',
        'VoucherYear',
        'WriteOffs',
    ];

    protected $writeable = [
        // 'Url',
        'Amount',
        'AmountCurrency',
        // 'Booked',
        // 'Currency',
        'CurrencyRate',
        // 'CurrencyUnit',
        'Information',
        'InvoiceNumber',
        // 'InvoiceDueDate',
        'InvoiceOCR',
        // 'InvoiceSupplierName',
        // 'InvoiceSupplierNumber',
        // 'InvoiceTotal',
        'ModeOfPayment',
        // 'Number',
        'PaymentDate',
        // 'Source',
        // 'VoucherNumber',
        // 'VoucherSeries',
        // 'VoucherYear',
        'WriteOffs',
    ];

    protected $required_create = [
    ];

    protected $required_update = [
    ];

    /**
     * Override the REST path.
     */
    protected $basePath = 'supplierinvoicepayments';

    /**
     * Retrieves a list of supplier invoice payments.
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
     * Retrieves a single supplier invoice payment.
     *
     * @param $number
     *
     * @return array
     */
    public function find($number)
    {
        $req = new FortieRequest();
        $req->method('GET');
        $req->path($this->basePath)->path($number);

        return $this->send($req->build());
    }

    /**
     * Creates a supplier invoice payment.
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
        $req->wrapper('SupplierInvoicePayment');
        $req->data($data);
        $req->setRequired($this->required_create);

        return $this->send($req->build());
    }

    /**
     * Updates a supplier invoice payment.
     *
     * @param $number
     * @param array $data
     *
     * @return array
     */
    public function update($number, array $data)
    {
        $req = new FortieRequest();
        $req->method('PUT');
        $req->path($this->basePath)->path($number);
        $req->wrapper('SupplierInvoicePayment');
        $req->setRequired($this->required_update);
        $req->data($data);

        return $this->send($req->build());
    }

    /**
     * Removes a supplier invoice payment.
     *
     * @param $number
     *
     * @return null
     */
    public function delete($number)
    {
        $req = new FortieRequest();
        $req->method('DELETE');
        $req->path($this->basePath)->path($number);

        return $this->send($req->build());
    }

    /**
     * Bookkeeps the supplier invoice payment.
     *
     * @param $number
     *
     * @return array
     */
    public function bookkeep($number)
    {
        $req = new FortieRequest();
        $req->method('PUT');
        $req->path($this->basePath)->path($number)->path('bookkeep');

        return $this->send($req->build());
    }
}
