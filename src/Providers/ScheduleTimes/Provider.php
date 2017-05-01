<?php namespace Wetcat\Fortie\Providers\ScheduleTimes;

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
    'EmployeeId',
    'Date',
    'ScheduleId',
    'Hours',
    'IWH1',
    'IWH2',
    'IWH3',
  ];


  protected $writeable = [
    'EmployeeId',
    'Date',
    'ScheduleId',
    'Hours',
    'IWH1',
    'IWH2',
    'IWH3',
  ];


  protected $required_create = [
  ];


  protected $required_update = [
  ];


  /**
   * Override the REST path
   */
  protected $basePath = 'scheduletimes';


  /**
   * Retrieve schedule time.
   *
   * Retrieves schedule time on a specific day for an employee.
   *
   * @param $employeeId
   * @param $date
   * @return array
   */
  public function find ($employeeId, $date)
  {
    $req = new FortieRequest();
    $req->method('GET');
    $req->path($this->basePath)->path($employeeId)->path($date);

    return $this->send($req->build());
  }


  /**
   * Updates a cost center.
   *
   * @param $employeeId
   * @param $date
   * @param array   $data
   * @return array
   */
  public function update ($employeeId, $date, array $data)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($employeeId)->path($date);
    $req->wrapper('ScheduleTime');
    $req->setRequired($this->required_update);
    $req->data($data);

    return $this->send($req->build());
  }


  /**
   * Reset schedule time.
   *
   * Resets schedule time of a day according to the schedule that is
   * assigned to the employee through the employment information.
   *
   * @param $code
   * @return null
   */
  public function reset ($employeeId, $date)
  {
    $req = new FortieRequest();
    $req->method('PUt');
    $req->path($this->basePath)->path($employeeId)->path($date)->path('resetday');

    return $this->send($req->build());
  }

}
