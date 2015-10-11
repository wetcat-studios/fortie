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

use Wetcat\Fortie\Providers\ProviderBase;


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

  protected $required = [
    'Name',
  ];

  /**
   * Override the REST path
   */
  protected $path = 'archive';


  /**
   * Retrieves a list of files.
   *
   * @param $dir
   * @return array
   */
  public function all ($dir)
  {
    return $this->sendRequest('GET', null, null, null, ['path' => $dir]);
  }


  /**
   * Retrieves a list of files and folders or a single file or folder.
   *
   * @param $file
   * @return array
   */
  public function find ($file)
  {
    return $this->sendRequest('GET', $file);
  }


  /**
   * Creates a new subdirectory either in root or in a specific 
   * subdirectory.
   *
   * @param array $params
   * @return array
   */
  public function subdir (array $params)
  {
    return $this->sendRequest('POST', null, 'Folder', $params);
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


}