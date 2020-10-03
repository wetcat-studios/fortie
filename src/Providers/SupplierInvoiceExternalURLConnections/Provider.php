<?php

namespace Wetcat\Fortie\Providers\SupplierInvoiceExternalURLConnections;

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
        'Code',
        'Description',
        'Note',
        'Active',
    ];

    protected $writeable = [
        // 'Url',
        'Code',
        'Description',
        'Note',
        'Active',
    ];

    protected $required_create = [
    ];

    protected $required_update = [
    ];

    /**
     * Override the REST path.
     */
    protected $basePath = 'supplierinvoiceexternalurlconnections';

    /**
     * Retrieves a single supplier invoice external URL connection.
     *
     * @param $id
     *
     * @return array
     */
    public function find($id)
    {
        $req = new FortieRequest();
        $req->method('GET');
        $req->path($this->basePath)->path($id);

        return $this->send($req->build());
    }

    /**
     * Creates an supplier invoice external URL connection.
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
        $req->wrapper('SupplierInvoiceExternalURLConnection');
        $req->data($data);
        $req->setRequired($this->required_create);

        return $this->send($req->build());
    }

    /**
     * Updates a supplier invoice external URL connection.
     *
     * @param $id
     * @param array $data
     *
     * @return array
     */
    public function update($id, array $data)
    {
        $req = new FortieRequest();
        $req->method('PUT');
        $req->path($this->basePath)->path($id);
        $req->wrapper('SupplierInvoiceExternalURLConnection');
        $req->setRequired($this->required_update);
        $req->data($data);

        return $this->send($req->build());
    }

    /**
     * Removes a supplier invoice external URL connection.
     *
     * @param $id
     *
     * @return null
     */
    public function delete($id)
    {
        $req = new FortieRequest();
        $req->method('DELETE');
        $req->path($this->basePath)->path($id);

        return $this->send($req->build());
    }
}
