<?php

namespace Wetcat\Fortie\Contracts;

class MetaInformation
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
