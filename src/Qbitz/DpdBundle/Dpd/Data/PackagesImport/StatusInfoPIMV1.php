<?php

namespace Qbitz\DpdBundle\Dpd\Data\PackagesImport;

use JMS\Serializer\Annotation as Serial;

class StatusInfoPIMV1 {

    /**
     * @Serial\Type("string")
     * @Serial\SerializedName("Status")
     */
    public $Status;

    /**
     * @Serial\Type("Qbitz\DpdBundle\Dpd\Data\PackagesImport\ErrorDetailsPIMV1")
     * @Serial\SerializedName("ErrorDetails")
     */
    public $ErrorDetails;
}
