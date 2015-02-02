<?php

namespace Qbitz\DpdBundle\Dpd\Data\PackagesImport;

use JMS\Serializer\Annotation as Serial;

class ParcelPIMV1 {

    /**
     * @Serial\Type("integer")
     * @Serial\SerializedName("ParcelId")
     */
    public $ParcelId;

    /**
     * @Serial\Type("string")
     * @Serial\SerializedName("OrderNumber")
     */
    public $OrderNumber;

    /**
     * @Serial\Type("string")
     * @Serial\SerializedName("Waybill")
     */
    public $Waybill;

    /**
     * @Serial\Type("Qbitz\DpdBundle\Dpd\Data\PackagesImport\StatusInfoPIMV1")
     * @Serial\SerializedName("StatusInfo")
     */
    public $StatusInfo;
}
