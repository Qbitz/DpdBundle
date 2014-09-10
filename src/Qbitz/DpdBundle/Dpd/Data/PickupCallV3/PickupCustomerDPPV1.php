<?php

namespace Qbitz\DpdBundle\Dpd\Data\PickupCallV3;

class PickupCustomerDPPV1
{
    public $customerName;
    public $customerFullName;
    public $customerPhone;

    public static function create($name, $fullName, $phone) {
        $ret = new PickupCustomerDPPV1();
        $ret->customerName = $name;
        $ret->customerFullName = $fullName;
        $ret->customerPhone = $phone;
        return $ret;
    }

}
