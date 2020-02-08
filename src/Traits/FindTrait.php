<?php

namespace Wetcat\Fortie\Traits;

use Wetcat\Fortie\FortieRequest;

trait FindTrait
{
  /**
   * Retrieves the details of an entities
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
}
