<?php namespace Wetcat\Fortie\Providers\TermsOfDeliveries;

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
  ];


  protected $writeable = [
    // 'Url',
    'Code',
    'Description',
  ];


  protected $required_create = [
  ];


  protected $required_update = [
  ];


  /**
   * Override the REST path
   */
  protected $basePath = 'termsofdeliveries';


  /**
   * Retrieves a list of terms of deliveries.
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
   * Retrieves a single terms of delivery.
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
   * Creates a terms of delivery.
   *
   * @param array   $data
   * @return array
   */
  public function create (array $data)
  {
    $req = new FortieRequest();
    $req->method('POST');
    $req->path($this->basePath);
    $req->wrapper('TermsOfDelivery');
    $req->data($data);
    $req->setRequired($this->required_create);

    return $this->send($req->build());
  }


  /**
   * Updates a terms of delivery.
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
    $req->wrapper('TermsOfDelivery');
    $req->setRequired($this->required_update);
    $req->data($data);

    return $this->send($req->build());
  }

}
