<?php

namespace Qbitz\DpdBundle\Dpd\Data\Document;

class StatusDGREnumV1
{
    const OK = 'OK';
    const NOT_FOUND = 'NOT_FOUND';
    const NOT_PROCESSED = 'NOT_PROCESSED';
    const INCORRECT_PKGS_FOR_SESSION_TYPE = 'INCORRECT_PKGS_FOR_SESSION_TYPE';
    const INCORRECT_PICKUP_ADDRESS_FID = 'INCORRECT_PICKUP_ADDRESS_FID';
    const INCORRECT_PICKUP_ADDRESS_NAME = 'INCORRECT_PICKUP_ADDRESS_NAME';
    const INCORRECT_PICKUP_ADDRESS_COMPANY = 'INCORRECT_PICKUP_ADDRESS_COMPANY';
    const INCORRECT_PICKUP_ADDRESS_ADDRESS = 'INCORRECT_PICKUP_ADDRESS_ADDRESS';
    const INCORRECT_PICKUP_ADDRESS_CITY = 'INCORRECT_PICKUP_ADDRESS_CITY';
    const INCORRECT_PICKUP_ADDRESS_COUNTRY = 'INCORRECT_PICKUP_ADDRESS_COUNTRY';
    const INCORRECT_PICKUP_ADDRESS_POSTAL_CODE = 'INCORRECT_PICKUP_ADDRESS_POSTAL_CODE';
    const INCORRECT_PICKUP_ADDRESS_EMAIL = 'INCORRECT_PICKUP_ADDRESS_EMAIL';
    const INCORRECT_PICKUP_ADDRESS_PHONE = 'INCORRECT_PICKUP_ADDRESS_PHONE';
    const PARCEL_LIMIT_EXCEEDED = 'PARCEL_LIMIT_EXCEEDED';
    const ACCESS_DENIED_FOR_FID = 'ACCESS_DENIED_FOR_FID';
    const DB_ERROR = 'DB_ERROR';
    const UNKNOWN_ERROR = 'UNKNOWN_ERROR';
    const ALREADY_ADVICED = 'ALREADY_ADVICED';
    const ADVICE_ERROR = 'ADVICE_ERROR';
}
