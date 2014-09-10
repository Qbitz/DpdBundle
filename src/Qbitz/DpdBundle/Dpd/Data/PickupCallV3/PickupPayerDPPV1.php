<?php

namespace Qbitz\DpdBundle\Dpd\Data\PickupCallV3;

class PickupPayerDPPV1
{
    public $payerNumber;
    public $payerName;
    public $payerCostCenter;

    public static function create($payerNumber, $payerName, $payerCostCenter) {
        $ret = new PickupPayerDPPV1();
        $ret->payerNumber = $payerNumber;
        $ret->payerName = $payerName;
        $ret->payerCostCenter = $payerCostCenter;
        return $ret;
    }

}
