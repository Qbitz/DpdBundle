<?php

namespace Qbitz\DpdBundle\Dpd\Data\PickupCallV3;

class PickupPackagesParamsDPPV1
{
    public $dox;
    public $standardParcel;
    public $pallet;
    public $parcelsCount;
    public $palletsCount;
    public $doxCount;
    public $parcelsWeight;
    public $parcelMaxWeight;
    public $parcelMaxHeight;
    public $parcelMaxWidth;
    public $parcelMaxDepth;
    public $palletsWeight;
    public $palletMaxWeight;
    public $palletMaxHeight;

    public static function createSingleDOX() {
        $ret = new PickupPackagesParamsDPPV1();
        $ret->dox = true;
        $ret->standardParcel = true;
        $ret->pallet = false;
        $ret->parcelsCount = 0;
        $ret->palletsCount = 0;
        $ret->doxCount = 1;
        $ret->parcelsWeight = 0;
        $ret->parcelMaxWeight = 0;
        $ret->parcelMaxHeight = 0;
        $ret->parcelMaxWidth = 0;
        $ret->parcelMaxDepth = 0;
        $ret->palletsWeight = 0;
        $ret->palletMaxWeight = 0;
        $ret->palletMaxHeight = 0;
        return $ret;
    }
}
