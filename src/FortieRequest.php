<?php namespace Wetcat\Fortie;

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

use Wetcat\Fortie\BaseProvider;

class FortieRequest
{

  /**
   * Url for the request, combined when the build() method is called.
   */
  private $URL = null;


  /**
   * The HTTP method of the request, this MUST be defined.
   */
  private $method = null;


  /**
   * The paths in the URL, including the basepath.
   */
  private $paths = [];


  /**
   * Special wrapper defined by many of the POST requests in Fortnox.
   */
  private $bodyWrapper = null;


  /**
   * Data array
   */
  private $data = [];


  /**
   * List of params
   */
  private $params = [];


  /**
   * Path for file uploads
   */
  private $filePath = null;


  /**
   * The optional filer, as defined by Fortnox. Applies only to some GET requests.
   */
  private $optionalFilter = null;


  /**
   * The array for required data, defined for POST & PUT requests
   */
  private $requiredData = null;


  /**
   * Base for the buildable Fortnox request, all methods of this object should
   * return itself so that the building of the request can be chainable.
   */
  public function __construct () {
  }


  /**
   * Set the HTTP method
   */
  public function method ($method = null)
  {
    if (is_null($method)) {
      throw new Exception('Method cannot be null!');
    }

    if (!($method === 'GET' || $method === 'POST' || $method === 'PUT' || $method === 'DELETE')) {
      throw new Exception('Method must be a valid HTTP method');
    }

    $this->method = $method;

    return $this;
  }


  /**
   * Add a path
   */
  public function path ($path = null)
  {
    if (!is_null($path)) {
      $this->paths[] = $path;
    }

    return $this;
  }


  /**
   * Set the data wrapper for the request
   */
  public function wrapper ($bodyWrapper = null)
  {
    if (!is_null($bodyWrapper)) {
      $this->bodyWrapper = $bodyWrapper;
    }

    return $this;
  }


  /**
   * Set the data for the request
   */
  public function data ($data = null)
  {
    if (!is_null($data)) {
      $this->data = $data;
    }

    return $this;
  }


  /**
   * Add/change a param for the request
   */
  public function param ($key, $value)
  {
    if (!is_null($params)) {
      $this->params[$key] = $value;
    }

    return $this;
  }


  /**
   * Set the filepath for file uploads
   */
  public function filePath ($filePath = null)
  {
    if (!is_null($filePath)) {
      $this->filePath = $filePath;
    }

    return $this;
  }


  /**
   * Set the required data for the request
   */
  public function setRequired (array $data = null)
  {
    $this->requiredData = $data;
  }


  /**
   * Set the filter for the request
   */
  public function filter ($filter = null)
  {
    if (!is_null($filter)) {
      $this->optionalFilter = $filter;
    }

    return $this;
  }


  /**
   * Returns the HTTP method
   */
  public function getMethod ()
  {
    return $this->method;
  }


  /**
   * Returns the URL
   */
  public function getUrl ()
  {
    return $this->URL;
  }


  /**
   * Returns the wrapper
   */
  public function getWrapper ()
  {
    return $this->bodyWrapper;
  }


  /**
   * Returns the data
   */
  public function getData ()
  {
    return $this->data;
  }


  /**
   * Returns the file path
   */
  public function getFile ()
  {
    return $this->filePath;
  }


  /**
   * Returns the required data keywords
   */
  public function getRequired ()
  {
    return $this->requiredData;
  }


  /**
   * Build the Guzzle request from the FortieRequest object.
   */
  public function build ()
  {
    // Start building the URL
    $this->URL = 'https://api.fortnox.se/3/';

    // Add the extra paths, if there are any
    if (!is_null($this->paths)) {
      // If array, add all paths
      if (is_array($this->paths)) {
        foreach ($this->paths as $path) {
          $this->URL .= $path . '/';
        }
      }
      // Otherwise, add just the first
      else {
        $this->URL .= $this->paths . '/';
      }
    }

    // Add the optional filter to params
    if (!is_null($this->optionalFilter)) {
      $this->params['filter'] = $this->optionalFilter;
    }

    // Apply the URL parameters, this must be an associative array
    if (!is_null($this->params) && is_array($this->params)) {
      $i = 0;
      foreach ($this->params as $key => $param) {
        // ?
        if ($i == 0) {
          $this->URL .= '?' . $key . '=' . $param;
        }
        // &
        else {
          $this->URL .= '&' . $key . '=' . $param;
        }
        $i++;
      }
    }

    return $this;
  }

}
