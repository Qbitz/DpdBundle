<?php

namespace Qbitz\DpdBundle\Dpd\Data\PickupCallV3;

class PickupSenderDPPV1
{
    public $senderName;
    public $senderFullName;
    public $senderAddress;
    public $senderCity;
    public $senderPostalCode;
    public $senderPhone;

    public static function create($name, $fullName, $address, $city, $postalCode, $phone) {
        $ret = new PickupSenderDPPV1();
        $ret->senderName = $name;
        $ret->senderFullName = $fullName;
        $ret->senderAddress = $address;
        $ret->senderCity = $city;
        $ret->senderPostalCode = $postalCode;
        $ret->senderPhone = $phone;
        return $ret;
    }

}
