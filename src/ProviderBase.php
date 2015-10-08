<?php namespace Wetcat\Fortie;


class ProviderBase
{

  /**
   * A reference to the client in Fortie.php
   */
  protected $client = null;


  /**
   * The base path for the Provider, defaults to 'accounts'.
   */
  protected $path = null;


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
   * The minimum required attributes for a write request.
   */
  protected $required = [
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
   * Send a HTTP request to Fortnox.
   */
  public function sendRequest ($method = 'GET', $paths = null, $bodyWrapper = null, $params = null)
  {
    // Start building the URL
    $URL = 'https://api.fortnox.se/3/' . $this->path . '/';
    // Add the extra paths, if there are any
    if (!is_null($paths)) {
      // If array, add all paths
      if (is_array($paths)) {
        foreach ($paths as $path) {
          $URL .= $path . '/';
        }
      }
      // Otherwise, add just the first
      else {
        $URL .= $paths . '/';
      }
    }

    $response = null;

    try {
      switch ($method) {
        case 'get':
        case 'GET':
          $response = $this->client->get($URL);
          break;
        
        case 'post':
        case 'POST':
          $body = $this->handleParams($bodyWrapper, $params);
          if (is_array($body)) {
            $response = $this->client->request($method, $URL, $body);
          } else {
            return 'ERROR!';
          }
          break;
      }
      
      return $this->handleResponse($response);
    }
    catch (\GuzzleHttp\Exception\ClientException $e) {
      $response = $e->getResponse();
      $responseBodyAsString = $response->getBody()->getContents();
      echo $responseBodyAsString;
    }
  }


  /**
   * This will perform filtering on the supplied parameters, used
   * when uploading data to Fortnox.
   */
  protected function handleParams ($bodyWrapper, $params)
  {
    // Filter invalid params
    $filtered = array_intersect_key($params, array_flip($this->attributes));;

    // Filter non-writeable params
    $writeable = array_intersect_key($filtered, array_flip($this->writeable));

    // Make sure all required params are set
    if (count(array_intersect_key(array_flip($this->required), $writeable)) === count($this->required)) {
      $body = [
        $bodyWrapper => $writeable
      ];
      return $body;
    }

    return false;
  }

}
