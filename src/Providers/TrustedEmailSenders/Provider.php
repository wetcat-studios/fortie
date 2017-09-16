<?php namespace Wetcat\Fortie\Providers\TrustedEmailSenders;

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
    'Id',
    'Email',
  ];


  protected $writeable = [
    // 'Id',
    'Email',
  ];


  protected $required_create = [
  ];


  protected $required_update = [
  ];


  /**
   * Override the REST path
   */
  protected $basePath = 'emailsenders';


  /**
   * Retrieve a list of all trusted and rejected senders.
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
   * Add a new email address as trusted.
   *
   * @param array   $data
   * @return array
   */
  public function create (array $data)
  {
    $req = new FortieRequest();
    $req->method('POST');
    $req->path($this->basePath)->path('trusted');
    $req->wrapper('TrustedSender');
    $req->data($data);
    $req->setRequired($this->required_create);

    return $this->send($req->build());
  }


  /**
   * Delete an email address from the trusted senders list. Provide an id
   * matching an email to delete.
   *
   * @param $id
   * @return null
   */
  public function delete ($id)
  {
    $req = new FortieRequest();
    $req->method('DELETE');
    $req->path($this->basePath)->path('trusted')->path($id);

    return $this->send($req->build());
  }

}
