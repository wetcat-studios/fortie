<?php namespace Wetcat\Fortie\Providers\Archive;

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

use Wetcat\Fortie\Exceptions\MissingRequiredAttributeException;
use Wetcat\Fortie\Providers\ProviderBase;
use Wetcat\Fortie\FortieRequest;

class Provider extends ProviderBase {

  protected $attributes = [
    'Url',
    'Comments',
    'Id',
    'Name',
    'Path',
    'Size',
    // Folder
    'Url',
    'Email',
    'Files',
    'Folders',
    'Id',
    'Name',
  ];


  protected $writeable = [
    'Name',
  ];


  protected $required_create = [
    'Name',
  ];


  protected $required_update = [
    'Name',
  ];


  /**
   * Override the REST path
   */
  protected $basePath = 'archive';


  /**
   * Retrieve the root folder.
   *
   * @param $dir
   * @return array
   */
  public function root ()
  {
    $req = new FortieRequest();
    $req->method('GET');
    $req->path($this->basePath);

    return $this->send($req->build());
  }


  /**
   * Retrieve the folder or file at the path.
   *
   * @param $path
   * @return array
   */
  public function findPath ($path)
  {
    if (is_null()) {
      throw new MissingRequiredAttributeException($requiredArr);
    }

    $req = new FortieRequest();
    $req->method('GET');
    $req->path($this->basePath);
    $req->param('path', $path);

    return $this->send($req->build());
  }


  /**
   * Creates a new subdirectory either in root or in a specific 
   * subdirectory.
   *
   * @param array $params
   * @return array
   */
  public function subdir ($name = null, $parent = null)
  {
    $req = new FortieRequest();
    $req->method('POST');
    $req->path($this->basePath);
    $req->wrapper('Folder');
    $req->setRequired($this->required_create);
    $req->data(['Name' => $name]);

    if (!is_null($parent)) {
      $req->param('path', $parent);
    }

    return $this->send($req->build());
  }


  /**
   * Upload a file to a specific subdirectory.
   *
   * @param array $params
   * @return array
   */
  public function upload ($file, $directory = null, $folder = null)
  {
    if (!is_null($directory)) {
      return $this->sendRequest('POST', null, null, null, ['path' => $directory], $file);
    }

    else if (!is_null($folder)) {
      return $this->sendRequest('POST', null, null, null, ['folderid' => $folder], $file);
    }
    
  }


  /**
   * Removes a file or folder.
   *
   * @param array   $params
   * @return array
   */
  public function delete ($file = null, $folder = null)
  {
    if (!is_null($file)) {
      return $this->sendRequest('DELETE', $file);
    }

    else if (!is_null($folder)) {
      return $this->sendRequest('DELETE', null, null, null, ['path' => $folder]);
    }
  }

  public function create (array $data)
  {
    throw new Exception('This is not implemented in Archive');
  }

  public function update ($id, array $data)
  {
    throw new Exception('This is not implemented in Archive');
  }

}
