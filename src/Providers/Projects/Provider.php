<?php namespace Wetcat\Fortie\Providers\Projects;

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
    'Comments',
    'ContactPerson',
    'Description',
    'EndDate',
    'ProjectLeader',
    'ProjectNumber',
    'Status',
    'StartDate',
  ];


  protected $writeable = [
    'ContactPerson',
    'Description',
    'EndDate',
    'ProjectLeader',
    'ProjectNumber',
    'Status',
    'StartDate',
  ];


  protected $required_create = [
  ];


  protected $required_update = [
  ];


  /**
   * Override the REST path
   */
  protected $basePath = 'projects';


  /**
   * Creates a project.
   *
   * @param array   $params
   * @return array
   */
  public function create (array $data)
  {
    $req = new FortieRequest();
    $req->method('POST');
    $req->path($this->basePath);
    $req->wrapper('Project');
    $req->setRequired($this->required_create);
    $req->data($data);

    return $this->send($req->build());
  }


  /**
   * Updates a project.
   *
   * @param array   $data
   * @return array
   */
  public function update ($id, array $data)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($id);
    $req->wrapper('Project');
    $req->setRequired($this->required_update);
    $req->data($data);

    return $this->send($req->build());
  }

}
