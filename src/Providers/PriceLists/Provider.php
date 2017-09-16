<?php namespace Wetcat\Fortie\Providers\PriceLists;

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
    'Comments',
    'PreSelected',
  ];


  protected $writeable = [
    'Code',
    'Description',
    'Comments',
  ];


  protected $required_create = [
    'Code',
    'Description',
  ];


  protected $required_update = [
  ];


  /**
   * Override the REST path
   */
  protected $basePath = 'pricelists';


  /**
   * Retrieves a list of price lists.
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
   * Retrieves a single price list.
   *
   * @param $id
   * @return array
   */
  public function find ($id)
  {
    $req = new FortieRequest();
    $req->method('GET');
    $req->path($this->basePath)->path($id);

    return $this->send($req->build());
  }


  /**
   * Creates a price list.
   *
   * @param array   $data
   * @return array
   */
  public function create (array $data)
  {
    $req = new FortieRequest();
    $req->method('POST');
    $req->path($this->basePath);
    $req->wrapper('PriceList');
    $req->setRequired($this->required_create);
    $req->data($data);

    return $this->send($req->build());
  }


  /**
   * Updates a price list.
   *
   * @param array   $data
   * @return array
   */
  public function update ($id, array $data)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath);
    $req->wrapper('PriceList');
    $req->setRequired($this->required_update);
    $req->data($data);

    return $this->send($req->build());
  }

}
