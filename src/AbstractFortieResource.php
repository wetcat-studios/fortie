<?php

namespace Wetcat\Fortie;

use Wetcat\Fortie\AbstractFortieResourceMeta;

abstract class AbstractFortieResource
{
    protected static $wrapper;

    public function __construct(object $fortnoxResponse = null)
    {
        if (!empty($fortnoxResponse->MetaInformation)) {
            $this->setMetaInformation($fortnoxResponse->MetaInformation);
        }

        if (!empty($fortnoxResponse->{static::$wrapper})) {
            $this->setItems($fortnoxResponse->{static::$wrapper});
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
        $this->{static::$wrapper} = $items;
    }
}
