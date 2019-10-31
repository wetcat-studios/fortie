<?php namespace Wetcat\Fortie\Providers\Units;

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

use Wetcat\Fortie\Contracts\Units as UnitsList;
use Wetcat\Fortie\FortieRequest;
use Wetcat\Fortie\Providers\ProviderBase;

class Provider extends ProviderBase {

  protected $attributes = [
    'Url',
    'Code',
    'Description',
  ];


  protected $writeable = [
    'Code',
    'Description',
  ];


  protected $required_create = [
    'Code',
    'Description',
  ];


  protected $required_update = [
  ];


  /**
   * The possible values for filtering the units.
   */
  protected $available_filters = [
  ];


  /**
   * Override the REST path
   */
  protected $basePath = 'units';


  /**
   * Retrieves the number of all units.
   *
   * @return integer
   */
  public function count()
  {
    $req = new FortieRequest();
    $req->method('GET');
    $req->path($this->basePath);
    $response = $this->send($req->build());

    return $response->MetaInformation->{'@TotalResources'};
  }


  /**
   * Retrieves a list of units.
   *
   * @return Wetcat\Fortie\Contracts\Units
   */
  public function all ($page = null)
  {
    if (!is_null($page)) {
      $this->page($page);
    }

    $req = new FortieRequest();
    $req->method('GET');
    $req->path($this->basePath);

    $req->param('page', $this->page);
    $req->param('offset', $this->offset);
    $req->param('limit', $this->limit);

    if (!is_null($this->timespan)) {
      $lastModified = date('Y-m-d H:i', strtotime($this->timespan));
      $req->param('lastmodified', $lastModified);
    }

    if (!is_null($this->filter)) {
      $req->param('filter', $this->filter);
    }

    if (!is_null($this->sort_order)) {
      $req->param('sortorder', $this->sort_order);
      $req->param('sortby', $this->sort_by);
    }

    $response = $this->send($req->build());

    return new UnitsList(
      $response->MetaInformation->{'@TotalResources'},
      $response->MetaInformation->{'@TotalPages'},
      $response->MetaInformation->{'@CurrentPage'},
      $response->Units
    );
  }


  /**
   * Retrieves a single unit.
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
   * Creates a unit.
   *
   * @param array   $data
   * @return array
   */
  public function create (array $data)
  {
    $req = new FortieRequest();
    $req->method('POST');
    $req->path($this->basePath);
    $req->wrapper('Unit');
    $req->setRequired($this->required_create);
    $req->data($data);

    return $this->send($req->build());
  }


  /**
   * Updates a unit.
   *
   * @param array   $data
   * @return array
   */
  public function update ($code, array $data)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($code);
    $req->wrapper('Unit');
    $req->setRequired($this->required_update);
    $req->data($data);

    return $this->send($req->build());
  }


  /**
   * Removes a unit.
   */
  public function delete ($code)
  {
    $req = new FortieRequest();
    $req->method('DELETE');
    $req->path($this->basePath)->path($code);

    return $this->send($req->build());
  }

}
