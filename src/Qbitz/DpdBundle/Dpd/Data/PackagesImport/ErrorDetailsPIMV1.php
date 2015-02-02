<?php

namespace Qbitz\DpdBundle\Dpd\Data\PackagesImport;

use JMS\Serializer\Annotation as Serial;

class ErrorDetailsPIMV1 {

    /**
     * @Serial\Type("string")
     * @Serial\SerializedName("Code")
     */
    public $Code;

    /**
     * @Serial\Type("string")
     * @Serial\SerializedName("Description")
     */
    public $Description;

    /**
     * @Serial\Type("string")
     * @Serial\SerializedName("Fields")
     */
    public $Fields;

}
