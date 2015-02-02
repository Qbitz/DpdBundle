<?php

namespace Qbitz\DpdBundle\Dpd\Data\OpenUMLFe;

use JMS\Serializer\Annotation as Serial;

/**
 * @Serial\XmlRoot("Address")
 */
class Address {
    /**
     * @Serial\SerializedName("FID")
     */
    public $fid;
    /**
     * @Serial\SerializedName("CountryCode")
     */
    public $countryCode;
    /**
     * @Serial\SerializedName("PostalCode")
     */
    public $postalCode;
    /**
     * @Serial\SerializedName("Company")
     */
    public $company;
    /**
     * @Serial\SerializedName("Name")
     */
    public $name;
    /**
     * @Serial\SerializedName("Address")
     */
    public $address;
    /**
     * @Serial\SerializedName("City")
     */
    public $city;
    /**
     * @Serial\SerializedName("Phone")
     */
    public $phone;
    /**
     * @Serial\SerializedName("Email")
     */
    public $email;

    public static function create($name, $company, $address, $city, $postalCode, $countryCode, $fid = null) {
        $ret = new Address();

        $ret->name = $name;
        $ret->company = $company;
        $ret->address = $address;
        $ret->city = $city;
        $ret->postalCode = $postalCode;
        $ret->countryCode = $countryCode;
        $ret->fid = $fid;

        return $ret;
    }
}
