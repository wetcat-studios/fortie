<?php

namespace Wetcat\Fortie;

abstract class AbstractFortieResource
{
    protected $wrapper;

    public function __construct(?object $fortnoxResponse = null)
    {
        if (! empty($fortnoxResponse->MetaInformation)) {
            $this->setMetaInformation($fortnoxResponse->MetaInformation);
        }

        if (! empty($fortnoxResponse->{$this->wrapper})) {
            $this->setItems($fortnoxResponse->{$this->wrapper});
        }
    }

    public function setMetaInformation(object $MetaInformation)
    {
        $this->MetaInformation = new AbstractFortieResourceMeta(
            $MetaInformation->{'@TotalResources'},
            $MetaInformation->{'@TotalPages'},
            $MetaInformation->{'@CurrentPage'}
        );
    }

    public function setItems(array $items)
    {
        $this->{$this->wrapper} = $items;
    }
}
