<?php namespace Wetcat\Fortie\Providers\AttendanceTransactions;

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

use Wetcat\Fortie\Exceptions\MissingRequiredAttributeException;
use Wetcat\Fortie\Providers\ProviderBase;
use Wetcat\Fortie\FortieRequest;

class Provider extends ProviderBase {

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
   * Override the REST path
   */
  protected $basePath = 'attendancetransactions';

  /**
   * List all attendance tarnsactions for all employees. Supports query-string
   * parameters employeeid and date for fitlering the result
   *
   * @return array
   */
  public function all ($page = null)
  {
    $req = new FortieRequest();
    $req->method('GET');
    $req->path($this->basePath);

    if (!is_null($page)) {  
      $req->param('page', $page);
    }

    return $this->send($req->build());
  }


  /**
   * Retrieves a single attendance transaction for an employee on a specific
   * date and cause code
   *
   * @param $employeeId
   * @param $date
   * @param $causeCode
   * @return array
   */
  public function find ($employeeId, $date, $causeCode)
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
   * @param array   $data
   * @return array
   */
  public function create (array $data)
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
   * @param array   $data
   * @return array
   */
  public function update ($fileId, array $data)
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
   * Deletes the article permanently.
   *
   * You need to supply the unique article number that was returned when the 
   * article was created or retrieved from the list of articles.
   */
  public function delete ($fileId)
  {
    $req = new FortieRequest();
    $req->method('DELETE');
    $req->path($this->basePath)->path($fileId);

    return $this->send($req->build());
  }

}
