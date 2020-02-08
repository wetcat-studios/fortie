<?php

namespace Wetcat\Fortie;

class AbstractFortieResourceMeta
{
    public function __construct(
        $TotalResources,
        $TotalPages,
        $CurrentPage
    )
    {
        $this->{'@TotalResources'} = $TotalResources;
        $this->{'@TotalPages'} = $TotalPages;
        $this->{'@CurrentPage'} = $CurrentPage;
    }
}
