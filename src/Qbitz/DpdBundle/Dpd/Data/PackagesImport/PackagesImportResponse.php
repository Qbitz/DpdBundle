<?php

namespace Qbitz\DpdBundle\Dpd\Data\PackagesImport;

use JMS\Serializer\Annotation as Serial;

class PackagesImportResponse {

    /**
     * @Serial\Type("integer")
     * @Serial\SerializedName("SessionId")
     */
    public $SessionId;

    /**
     * @Serial\Type("string")
     * @Serial\SerializedName("BeginTime")
     */
    public $BeginTime;

    /**
     * @Serial\Type("string")
     * @Serial\SerializedName("EndTime")
     */
    public $EndTime;

    /**
     * @Serial\Type("Qbitz\DpdBundle\Dpd\Data\PackagesImport\StatusInfoPIMV1")
     * @Serial\SerializedName("StatusInfo")
     */
    public $StatusInfo;

    /**
     * @Serial\Type("array<Qbitz\DpdBundle\Dpd\Data\PackagesImport\PackagePIMV1>")
     * @Serial\SerializedName("Packages")
     * @Serial\XmlList(entry = "Package")
     */
    public $Packages;

}
