<?php

namespace Wetcat\Fortie\Traits;

use Wetcat\Fortie\FortieRequest;

trait CreateTrait
{
    /**
     * Creates entity.
     * The created entity will be returned if succeeded,
     * otherwise throws exception.
     *
     * @param array $data
     *
     * @return array
     */
    public function create(array $data)
    {
        $req = new FortieRequest();
        $req->method('POST');
        $req->path($this->basePath);
        $req->wrapper($this->wrapper);
        $req->setRequired($this->required_create);
        $req->data($data);

        return $this->send($req->build());
    }
}
