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
  protected $path = 'accounts';


  /**
   * List of allowed attributes in the provider, any other
   * attributes will be filtered. Defaults to empty.
   */
  protected $attributes = [];


  /**
   *
   */

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
        return $response->getBody();
      } 
  }


  public function sendRequest ($method = 'GET', $params = [])
  {
    // Start building the URL
//    $URL = 'https://api.fortnox.se/3/' . $this->path . '/';
    // Add the extra paths, if there are any
    if (count($params) > 0) {
      foreach ($params as $param) {
        $URL .= $param . '/';
      }
    }

    try {
        //$request = $this->client->request($method, $URL, []);

        $response = $this->client->request($method, $this->path);


        //$response = $client->send($request);
        echo "Response HTTP : " . $response->getStatusCode();
    }
    catch (RequestException $e) {
      return "ERROR!";
        echo "HTTP Request failed\n";
        echo $e->getRequest();
        if ($e->hasResponse()) {
            echo $e->getResponse();
        }
    }
  }

}
