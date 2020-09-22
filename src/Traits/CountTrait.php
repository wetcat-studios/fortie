<?php

namespace Wetcat\Fortie\Traits;

use Wetcat\Fortie\FortieRequest;

trait CountTrait
{
    /**
     * Retrieves the number of entities,
     * obeying settings for filtering.
     *
     * @return int
     */
    public function count()
    {
        $req = new FortieRequest();
        $req->method('GET');
        $req->path($this->basePath);

        if (! is_null($this->timespan)) {
            $lastModified = date('Y-m-d H:i', strtotime($this->timespan));
            $req->param('lastmodified', $lastModified);
        }

        if (! is_null($this->filter)) {
            $req->param('filter', $this->filter);
        }

        $response = $this->send($req->build());

        return $response->MetaInformation->{'@TotalResources'};
    }
}
