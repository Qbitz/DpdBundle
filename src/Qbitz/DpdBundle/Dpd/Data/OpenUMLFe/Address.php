<?php

namespace Qbitz\DpdBundle\Dpd\Data\OpenUMLFe;

class Address {
    public $fid;
    public $countryCode;
    public $postalCode;
    public $company;
    public $name;
    public $address;
    public $city;
    public $phone;
    public $email;

    public static function create($company, $address, $city, $postalCode, $countryCode, $fid = null) {
        $ret = new Address();

        $ret->company = $company;
        $ret->address = $address;
        $ret->city = $city;
        $ret->postalCode = $postalCode;
        $ret->countryCode = $countryCode;
        $ret->fid = $fid;

        return $ret;
    }
}
