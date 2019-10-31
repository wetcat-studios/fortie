<?php

namespace Wetcat\Fortie\Contracts;

abstract class AbstractResponse
{
    public $MetaInformation;

    public function __construct(
        $TotalResources,
        $TotalPages,
        $CurrentPage,
        $items
    )
    {
        $this->MetaInformation = new MetaInformation(
            $TotalResources,
            $TotalPages,
            $CurrentPage
        );

        $this->{class_basename($this)} = $items;
    }
}
