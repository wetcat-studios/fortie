<?php namespace Wetcat\Fortie\Providers\PredefinedVoucherSeries;

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
    'Name',
    'VoucherSeries',
  ];


  protected $writeable = [
    // 'Url',
    // 'Name',
    'VoucherSeries',
  ];


  protected $required_create = [
  ];


  protected $required_update = [
  ];


  /**
   * Override the REST path
   */
  protected $basePath = 'predefinedvoucherseries';


  /**
   * Retrieve a list of all predefined voucher series.
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
   * Retrieve predefined series for a specific voucher type.
   *
   * @param $name
   * @return array
   */
  public function find ($name)
  {
    $req = new FortieRequest();
    $req->method('GET');
    $req->path($this->basePath)->path(strtoupper($name));

    return $this->send($req->build());
  }


  /**
   * Update existing voucher type with a predefined voucher series.
   *
   * @param $name
   * @param array   $data
   * @return array
   */
  public function update ($name, array $data)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path(strtoupper($name));
    $req->wrapper('PreDefinedVoucherSeries');
    $req->setRequired($this->required_update);
    $req->data($data);

    return $this->send($req->build());
  }

}
