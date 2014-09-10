<?php

namespace Qbitz\DpdBundle\Dpd\Data\PickupCallV3;

class DpdPickupCallParamsV3
{
    public $operationType;
    public $updateMode;
    public $orderNumber;
    public $checkSum;
    public $pickupDate;
    public $pickupTimeFrom;
    public $pickupTimeTo;
    public $orderType;
    public $waybillsReady;
    public $pickupCallSimplifiedDetails;

    public static function createInsert($pickupDate, $pickupTimeFrom, $pickupTimeTo) {
        $ret = new DpdPickupCallParamsV3();

        $ret->operationType = PickupCallOperationTypeDPPEnumV1::INSERT;
        $ret->updateMode = null;
        $ret->orderNumber = null;
        $ret->checkSum = null;
        $ret->orderType = PickupCallOrderTypeDPPEnumV1::DOMESTIC;
        $ret->waybillsReady = true;

        $ret->pickupDate = $pickupDate;
        $ret->pickupTimeFrom = $pickupTimeFrom;
        $ret->pickupTimeTo = $pickupTimeTo;

        return $ret;
    }
}
