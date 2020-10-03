<?php

namespace Wetcat\Fortie\Providers\VoucherFileConnections;

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
        'FileId',
        'VoucherDescription',
        'VoucherNumber',
        'VoucherSeries',
        'VoucherYear',
    ];

    protected $writeable = [
        // 'Url',
        'FileId',
        // 'VoucherDescription',
        'VoucherNumber',
        'VoucherSeries',
        // 'VoucherYear',
    ];

    protected $required_create = [
    ];

    protected $required_update = [
    ];

    /**
     * Override the REST path.
     */
    protected $basePath = 'voucherfileconnections';

    /**
     * Retrieves a list of voucher file connections.
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
     * Retrieves a single voucher file connection.
     *
     * @param $fileId
     *
     * @return array
     */
    public function find($fileId)
    {
        $req = new FortieRequest();
        $req->method('GET');
        $req->path($this->basePath)->path($fileId);

        return $this->send($req->build());
    }

    /**
     * Creates an voucher file connection.
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
        $req->wrapper('CostCenter');
        $req->data($data);
        $req->setRequired($this->required_create);

        return $this->send($req->build());
    }

    /**
     * Removes an voucher file connection.
     *
     * @param $fileId
     *
     * @return null
     */
    public function delete($fileId)
    {
        $req = new FortieRequest();
        $req->method('DELETE');
        $req->path($this->basePath)->path($fileId);

        return $this->send($req->build());
    }
}
