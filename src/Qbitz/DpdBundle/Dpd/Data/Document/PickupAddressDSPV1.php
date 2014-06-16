<?php

namespace Qbitz\DpdBundle\Dpd\Data\Document;

class PickupAddressDSPV1
{
    public $fid;
    public $name;
    public $company;
    public $address;
    public $city;
    public $countryCode;
    public $postalCode;
    public $phone;
    public $email;

    public static function create($name, $company, $address, $city, $postalCode, $countryCode='PL') {
        $ret = new PickupAddressDSPV1();

        $ret->name = $name;
        $ret->company = $company;
        $ret->address = $address;
        $ret->city = $city;
        $ret->countryCode = $countryCode;
        $ret->postalCode = $postalCode;

        return $ret;
    }

}
