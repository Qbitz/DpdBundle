<?php

namespace Qbitz\DpdBundle\Dpd\Data\OpenUMLFe;

class Parcel {
    public $weight;
    public $sizeX;
    public $sizeY;
    public $sizeZ;
    public $content;
    public $customerData1;
    public $customerData2;
    public $customerData3;

    public function __construct($weight = null) {
        $this->weight = $weight;
    }

    public static function create($weight) {
        return new Parcel($weight);
    }

    public function setContent($content) {
        $this->content = $content;

        return $this;
    }

    public function setCustomerData($data) {
        $this->customerData1 = $data;

        return $this;
    }
}
