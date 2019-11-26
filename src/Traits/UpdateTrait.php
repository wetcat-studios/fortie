<?php

namespace Wetcat\Fortie\Traits;

use Wetcat\Fortie\FortieRequest;

trait UpdateTrait
{
  /**
   * Updates the details of an entity.
   * The created entity will be returned if succeeded,
   * otherwise throws exception.
   *
   * Only the properties provided in the request body will be updated,
   * properties not provided will left unchanged.
   *
   * @param array   $data
   * @return array
   */
  public function update ($id, array $data)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($id);
    $req->wrapper(static::$wrapper);
    $req->setRequired($this->required_update);
    $req->data($data);

    return $this->send($req->build());
  }
}
