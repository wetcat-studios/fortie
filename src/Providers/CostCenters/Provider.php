<?php namespace Wetcat\Fortie\Providers\CostCenters;

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
   * Override the REST path
   */
  protected $basePath = 'costcenters';


  /**
   * Retrieves a list of cost centers.
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


  /**
   * Retrieves a single cost center.
   *
   * @param $code
   * @return array
   */
  public function find ($code)
  {
    $req = new FortieRequest();
    $req->method('GET');
    $req->path($this->basePath)->path($code);

    return $this->send($req->build());
  }


  /**
   * Creates a cost center.
   *
   * @param array   $data
   * @return array
   */
  public function create (array $data)
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
   * Updates a cost center.
   *
   * @param $code
   * @param array   $data
   * @return array
   */
  public function update ($code, array $data)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($code);
    $req->wrapper('CostCenter');
    $req->setRequired($this->required_update);
    $req->data($data);

    return $this->send($req->build());
  }


  /**
   * Removes a cost center.
   *
   * @param $code
   * @return null
   */
  public function delete ($code)
  {
    $req = new FortieRequest();
    $req->method('DELETE');
    $req->path($this->basePath)->path($code);

    return $this->send($req->build());
  }

}
