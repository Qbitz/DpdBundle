<?php

namespace Qbitz\DpdBundle\Dpd\Data\OpenUMLFe;

use JMS\Serializer\Annotation as Serial;

/**
 * @Serial\XmlRoot("Parcel")
 */
class Parcel {
    /**
     * @Serial\SerializedName("Weight")
     */
    public $weight = 0;
    /**
     * @Serial\SerializedName("SizeX")
     */
    public $sizeX = 0;
    /**
     * @Serial\SerializedName("SizeY")
     */
    public $sizeY = 0;
    /**
     * @Serial\SerializedName("SizeZ")
     */
    public $sizeZ = 0;
    /**
     * @Serial\SerializedName("Content")
     */
    public $content = '';
    /**
     * @Serial\SerializedName("CustomerData1")
     */
    public $customerData1 = '';
    /**
     * @Serial\SerializedName("CustomerData2")
     */
    public $customerData2 = '';
    /**
     * @Serial\SerializedName("CustomerData3")
     */
    public $customerData3 = '';

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
