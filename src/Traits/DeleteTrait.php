<?php

namespace Wetcat\Fortie\Traits;

use Wetcat\Fortie\FortieRequest;

trait DeleteTrait
{
    /**
     * Permanently deletes the entity
     * “204 – No content” will be returned if succeeded
     * otherwise throws exception.
     *
     * @param mixed $id
     */
    public function delete($id)
    {
        $req = new FortieRequest();
        $req->method('DELETE');
        $req->path($this->basePath);
        $req->path($id);

        return $this->send($req->build());
    }
}
