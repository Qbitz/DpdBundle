<?php

namespace Qbitz\DpdBundle\Dpd\Data\Courier;

class SenderPlaceV1
{
    public $countryCode;
    public $zipCode;

    public function __construct($countryCode = null, $zipCode = null) {
        $this->countryCode = $countryCode;
        $this->zipCode = $zipCode;
    }
}
