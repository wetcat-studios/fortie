<?php namespace Wetcat\Fortie\Providers\FinancialYears;

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
    'Id',
    'FromDate',
    'ToDate',
    'AccountChartType',
    'AccountingMethod',
  ];


  protected $writeable = [
    // 'Url',
    // 'Id',
    'FromDate',
    'ToDate',
    'AccountChartType',
    'AccountingMethod',
  ];

  protected $required_create = [
  ];


  protected $required_update = [
  ];


  /**
   * Override the REST path
   */
  protected $basePath = 'financialyears';


  /**
   * Retrieves a list of financial years.
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
   * Retrieves a single financial year.
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
   * Creates a financial year.
   *
   * @param array   $data
   * @return array
   */
  public function create (array $data)
  {
    $req = new FortieRequest();
    $req->method('POST');
    $req->path($this->basePath);
    $req->wrapper('FinancialYear');
    $req->data($data);
    $req->setRequired($this->required_create);

    return $this->send($req->build());
  }


  /**
   * It is possible to find a financial year based on a date, this is done by
   * a search with the parameter “date”.
   *
   * @param $code
   * @return array
   */
  public function search ($date)
  {
    $req = new FortieRequest();
    $req->method('GET');
    $req->path($this->basePath)->path($id);
    $req->param('date', $date);

    return $this->send($req->build());
  }

}
