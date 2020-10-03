<?php

namespace Wetcat\Fortie\Providers\AttendanceTransactions;

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

use DateTimeInterface;
use Wetcat\Fortie\Exceptions\MissingRequiredAttributeException;
use Wetcat\Fortie\FortieRequest;
use Wetcat\Fortie\Providers\ProviderBase;

class Provider extends ProviderBase
{
    protected $attributes = [
        'EmployeeId',
        'CauseCode',
        'Date',
        'Hours',
    ];

    protected $writeable = [
        'EmployeeId',
        'CauseCode',
        'Date',
        'Hours',
    ];

    protected $required_create = [
    ];

    protected $required_update = [
    ];

    /**
     * Override the REST path.
     */
    protected $basePath = 'attendancetransactions';

    /**
     * List all attendance tarnsactions for all employees. Supports query-string
     * parameters employeeid and date for fitlering the result.
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
     * Retrieves a single attendance transaction for an employee on a specific
     * date and cause code.
     *
     * @param $employeeId
     * @param $date
     * @param $causeCode
     *
     * @return array
     */
    public function find($employeeId, $date, $causeCode)
    {
        if (is_null($employeeId) || is_null($date) || is_null($causeCode)) {
            throw new MissingRequiredAttributeException(['employeeId', 'date', 'causeCode']);
        }

        $req = new FortieRequest();
        $req->method('GET');
        $req->path($this->basePath)->path($employeeId)->path($date)->path($causeCode);

        return $this->send($req->build());
    }

    /**
     * Creates a new attendance transaction for an employee.
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
        $req->wrapper('AttendanceTransaction');
        $req->data($data);
        $req->setRequired($this->required_create);

        return $this->send($req->build());
    }

    /**
     * Updates an attendance transaction.
     *
     * @param array $data
     * @param mixed $fileId
     *
     * @return array
     */
    public function update($fileId, array $data)
    {
        $req = new FortieRequest();
        $req->method('PUT');
        $req->path($this->basePath)->path($fileId);
        $req->wrapper('AttendanceTransaction');
        $req->setRequired($this->required_update);
        $req->data($data);

        return $this->send($req->build());
    }

    /**
     * Removes an attendance transaction.
     *
     * @param string $employeeId
     * @param DateTimeInterface $date
     * @param string $causeCode
     *
     * @return array
     */
    public function delete($employeeId, DateTimeInterface $date, $causeCode)
    {
        $req = new FortieRequest();
        $req->method('DELETE');
        $req->path($this->basePath)->path($employeeId)->path($date->format('Y-m-d'))->path($causeCode);

        return $this->send($req->build());
    }
}
