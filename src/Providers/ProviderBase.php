<?php namespace Wetcat\Fortie\Providers;

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
use Wetcat\Fortie\Exceptions\FortnoxException;
use Wetcat\Fortie\FortieRequest;


/**
 * Base provider for the all Fortnox providers, each provider includes a
 * path (the URL extension for the provider, for example "accounts") and
 * a set of attributes (both writeable and required).
 *
 * Before a request is sent to Fortnox the supplied parameter array will
 * be sanitized according to the rules in Fortnox defined by the online
 * documentation (http://developer.fortnox.se/documentation/). When the
 * data has been verified the data is sent to the Guzzle client.
 *
 * The response (either XML or JSON) is then turned into an array and
 * retured to the caller.
 */
abstract class ProviderBase
{

  /**
   * A reference to the client in Fortie.php
   */
  protected $client = null;


  /**
   * The base path for the Provider.
   */
  protected $basePath = null;


  /**
   * List of readable attributes.
   */
  protected $attributes = [
  ];


  /**
   * The writeable attributes.
   */
  protected $writeable = [
  ];


  /**
   * The minimum required attributes for a create request.
   */
  protected $required_create = [
  ];


  /**
   * The minimum required attributes for an update request.
   */
  protected $required_update = [
  ];


  /**
   * Create a new provider instance, pass the Guzzle client
   * reference.
   *
   * @return void
   */
  public function __construct(&$client)
  {
    $this->client = $client;
  }


  /**
   * Base retrieve function
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
   * Base find function
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
   * Base create function
   *
   * @param array   $params
   * @return array
   */
  abstract public function create (array $data);


  /**
   * Updates a project.
   *
   * @param array   $params
   * @return array
   */
  abstract public function update ($id, array $data);
  

  /**
   * Base delete function
   *
   * @param $id   The resource id
   * @return array
   */
  public function delete ($id)
  {
    $req = new FortieRequest();
    $req->method('DELETE');
    $req->path($this->basePath)->path($id);

    return $this->send($req->build());
  }


  /**
   * Handle the response, whether it's JSON or XML.
   */
  protected function handleResponse (\GuzzleHttp\Psr7\Response $response)
  {
    $content_type = $response->getHeader('Content-Type');

    if (in_array('application/json', $content_type)) {
      return json_decode($response->getBody());
    }

    else if (in_array('application/xml', $content_type)) {
      $reader = new \Sabre\Xml\Reader();
      $reader->xml($response->getBody());
      return $reader->parse();
    }
  }


  /**
   * This will perform filtering on the supplied data, used when uploading data
   * to Fortnox.
   */
  protected function handleData ($requiredArr = null, $bodyWrapper, $data, $sanitize = true)
  {
    // Filter invalid data
    $filtered = array_intersect_key($data, array_flip($this->attributes));;

    // Filter non-writeable data
    $writeable = array_intersect_key($filtered, array_flip($this->writeable));

    // Make sure all required data are set
    if (! (count(array_intersect_key(array_flip($requiredArr), $writeable)) === count($requiredArr))) {
      throw new MissingRequiredAttributeException($requiredArr);
    }

    // Sanitize input 
    // See: http://guzzle3.readthedocs.org/http-client/request.html#post-requests
    if ($sanitize) {
      foreach ($writeable as $key => $value) {
        $value = str_replace('@', '', $value);
      }
    }

    // Wrap the body as required by Fortnox
    $body = [
      $bodyWrapper => $writeable
    ];

    return $body;
  }


  /**
   * Send a FortieRequest to Fortnox
   */
  public function send (FortieRequest $request)
  {
    $response = null;

    try {
      switch ($request->getMethod()) {
        case 'delete':
        case 'DELETE':
          $response = $this->client->delete($request->getUrl());
          break;

        case 'get':
        case 'GET':
          $response = $this->client->get($request->getUrl());
          break;
        
        case 'post':
        case 'POST':
          // If there's a file path available then we'll proceed with uploading that file
          if (!is_null($request->getFile())) {
            $body = fopen($request->getFile(), 'r');
            $response = $this->client->post($request->getUrl(), ['body' => $body]);
          }

          // otherwise assume it's normal POST
          else {
            // Get the correct filter, if there is nothing required then set empty array
            $required = (!is_null($request->getRequired()) ? $request->getRequired() : []);

            $body = $this->handleData($required, $request->getWrapper(), $request->getData());
            
            $response = $this->client->post($request->getUrl(), ['json' => $body]);
          }
          break;

        case 'put':
        case 'PUT':
          // If there's a file path available then we'll proceed with uploading that file
          if (!is_null($request->getFile())) {
            $body = fopen($request->getFile(), 'r');
            $response = $this->client->put($request->getUrl(), ['body' => $body]);
          }

          // otherwise assume it's normal PUT
          else {
            // Get the correct filter, if there is nothing required then set empty array
            $required = (!is_null($request->getRequired()) ? $request->getRequired() : []);

            $body = $this->handleData($required, $request->getWrapper(), $request->getData());
            $response = $this->client->put($request->getUrl(), ['json' => $body]);
          }
      }

      return $this->handleResponse($response);
    }
    catch (\GuzzleHttp\Exception\ClientException $e) {
      $response = $e->getResponse();
      $responseBodyAsString = $response->getBody()->getContents();
      $jsonError = json_decode($responseBodyAsString);

      // Because Fortnox API can use both non-capitalized and capitalized parameters.
      if (property_exists($jsonError->ErrorInformation, 'error')) {
        throw new FortnoxException(
          $jsonError->ErrorInformation->error,
          $jsonError->ErrorInformation->message,
          $jsonError->ErrorInformation->code
        );
      } else {
        throw new FortnoxException(
          $jsonError->ErrorInformation->Error,
          $jsonError->ErrorInformation->Message,
          $jsonError->ErrorInformation->Code
        );
      }
    }
  }

}
