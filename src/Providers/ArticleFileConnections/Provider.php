<?php namespace Wetcat\Fortie\Providers\ArticleFileConnections;

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
    'FileId',
    'ArticleNumber',
  ];


  protected $writeable = [
    // 'Url',
    'FileId',
    'ArticleNumber',
  ];


  protected $required_create = [
  ];


  protected $required_update = [
  ];


  /**
   * Override the REST path
   */
  protected $basePath = 'articlefileconnections';


  /**
   * Retrieves a list of article file connections or a single article
   * file connection.
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
   * Retrieves the details of an account. You need to supply the unique 
   * account number that was returned when the account was created or 
   * retrieved from the list of accounts.
   *
   * @param $fileId
   * @return array
   */
  public function find ($fileId)
  {
    $req = new FortieRequest();
    $req->method('GET');
    $req->path($this->basePath)->path($fileId);

    return $this->send($req->build());
  }


  /**
   * Creates a new absence transaction for an employee.
   *
   * @param array   $data
   * @return array
   */
  public function create (array $data)
  {
    $req = new FortieRequest();
    $req->method('POST');
    $req->path($this->basePath);
    $req->wrapper('ArticleFileConnection');
    $req->data($data);
    $req->setRequired($this->required_create);

    return $this->send($req->build());
  }


  /**
   * Updates an absence transaction.
   *
   * @param array   $data
   * @return array
   */
  public function update ($fileId, array $data)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($fileId);
    $req->wrapper('ArticleFileConnection');
    $req->setRequired($this->required_update);
    $req->data($data);

    return $this->send($req->build());
  }


  /**
   * Deletes the article permanently.
   *
   * You need to supply the unique article number that was returned when the 
   * article was created or retrieved from the list of articles.
   */
  public function delete ($fileId)
  {
    $req = new FortieRequest();
    $req->method('DELETE');
    $req->path($this->basePath)->path($fileId);

    return $this->send($req->build());
  }

}
