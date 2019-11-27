<?php

namespace Wetcat\Fortie\Traits;

use Wetcat\Fortie\FortieRequest;

trait FetchTrait
{
    /**
     * Retrieves a list of entities.
     *
     * @param null|mixed $page
     *
     * @return Wetcat\Fortie\AbstractFortieResource
     */
    public function all($page = null)
    {
        if ($this->limit > 0) {
            return $this->fetch($page);
        }

        return $this->fetchAll();
    }

    /**
     * Retrieves a list of entities
     * obeying settings for pagination, filtering and sorting.
     *
     * @param null|mixed $page
     *
     * @return Wetcat\Fortie\AbstractFortieResource
     */
    public function fetch($page = null)
    {
        if (! is_null($page)) {
            $this->page($page);
        }

        $req = new FortieRequest();
        $req->method('GET');
        $req->path($this->basePath);

        $req->param('page', $this->page);
        $req->param('offset', $this->offset);
        $req->param('limit', $this->limit);

        if (! is_null($this->timespan)) {
            $lastModified = date('Y-m-d H:i', strtotime($this->timespan));
            $req->param('lastmodified', $lastModified);
        }

        if (! is_null($this->filter)) {
            $req->param('filter', $this->filter);
        }

        if (! is_null($this->sort_order)) {
            $req->param('sortorder', $this->sort_order);
            $req->param('sortby', $this->sort_by);
        }

        return $this->makeResource(
            $this->send($req->build())
        );
    }

    /**
     * Retrieves an unpaginated full list of all entities
     * obeying settings for filtering and sorting.
     *
     * @return Wetcat\Fortie\AbstractFortieResource
     */
    public function fetchAll()
    {
        $items = [];
        $currentPage = 0;
        $totalPages = 1;

        while ($currentPage < $totalPages) {
            $currentPage++;
            $response = $this->limit($this->default_limit)
                ->page($currentPage)
                ->fetch();

            $fullResponse = $fullResponse ?? clone $response;

            $totalPages = $response->MetaInformation->{'@TotalPages'};
            $currentPage = $response->MetaInformation->{'@CurrentPage'};

            $items = array_merge(
                $items,
                $this->page($currentPage)->all()->{$this->wrapperGroup}
            );
        }

        // force overwriting meta information header
        $fullResponse->MetaInformation->{'@TotalResources'} = count($items);
        $fullResponse->MetaInformation->{'@TotalPages'} = 1;
        $fullResponse->MetaInformation->{'@CurrentPage'} = 1;
        $fullResponse->{$this->wrapperGroup} = $items;

        return $this->makeResource(
            $fullResponse
        );
    }

    /**
     * Creates a resource instance of the given entity type.
     *
     * @param object $response Fortnox3 API response
     *
     * @return Wetcat\Fortie\AbstractFortieResource
     */
    protected function makeResource($response)
    {
        $resourceClass = '\\Wetcat\\Fortie\\Providers\\' . $this->wrapperGroup . '\\Resource';

        return new $resourceClass($response);
    }
}
