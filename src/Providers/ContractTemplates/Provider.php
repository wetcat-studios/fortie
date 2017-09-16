<?php namespace Wetcat\Fortie\Providers\ContractTemplates;

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
    'AdministrationFee',
    'ContractLength',
    'Freight',
    'InvoiceInterval',
    'InvoiceRows',
    'Continuous',
    'OurReference',
    'PrintTemplate',
    'Remarks',
    'TemplateName',
    'TemplateNumber',
    'TermsOfDelivery',
    'TermsOfPayment',
    'WayOfDelivery',
  ];


  protected $writeable = [
    // 'Url',
    'AdministrationFee',
    'ContractLength',
    'Freight',
    'InvoiceInterval',
    'InvoiceRows',
    'Continuous',
    'OurReference',
    'PrintTemplate',
    'Remarks',
    'TemplateName',
    'TemplateNumber',
    'TermsOfDelivery',
    'TermsOfPayment',
    'WayOfDelivery',
  ];


  protected $required_create = [
  ];


  protected $required_update = [
  ];


  /**
   * Override the REST path
   */
  protected $basePath = 'contracttemplates';


  /**
   * Retrieves a list of contract templates.
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
   * Retrieves a single contract template.
   *
   * @param $templateNumber
   * @return array
   */
  public function find ($templateNumber)
  {
    $req = new FortieRequest();
    $req->method('GET');
    $req->path($this->basePath)->path($templateNumber);

    return $this->send($req->build());
  }


  /**
   * Creates a contract template.
   *
   * @param array   $data
   * @return array
   */
  public function create (array $data)
  {
    $req = new FortieRequest();
    $req->method('POST');
    $req->path($this->basePath);
    $req->wrapper('ContractTemplate');
    $req->data($data);
    $req->setRequired($this->required_create);

    return $this->send($req->build());
  }


  /**
   * Updates a contract template.
   *
   * @param $templateNumber
   * @param array   $data
   * @return array
   */
  public function update ($templateNumber, array $data)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($templateNumber);
    $req->wrapper('ContractTemplate');
    $req->setRequired($this->required_update);
    $req->data($data);

    return $this->send($req->build());
  }

}
