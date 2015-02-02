<?php

namespace Qbitz\DpdBundle\Dpd\Data\PackagesImport;

use JMS\Serializer\Annotation as Serial;

class PackagePIMV1 {

    /**
     * @Serial\Type("integer")
     * @Serial\SerializedName("PackageId")
     */
    public $PackageId;

    /**
     * @Serial\Type("string")
     * @Serial\SerializedName("OrderNumber")
     */
    public $OrderNumber;

    /**
     * @Serial\Type("string")
     * @Serial\SerializedName("Reference")
     */
    public $Reference;

    /**
     * @Serial\Type("Qbitz\DpdBundle\Dpd\Data\PackagesImport\StatusInfoPIMV1")
     * @Serial\SerializedName("StatusInfo")
     */
    public $StatusInfo;

    /**
     * @Serial\Type("array<Qbitz\DpdBundle\Dpd\Data\PackagesImport\ParcelPIMV1>")
     * @Serial\SerializedName("Parcels")
     * @Serial\XmlList(entry = "Parcel")
     */
    public $Parcels;

}
