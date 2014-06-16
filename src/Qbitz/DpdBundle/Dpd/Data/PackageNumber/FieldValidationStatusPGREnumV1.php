<?php

namespace Qbitz\DpdBundle\Dpd\Data\PackageNumber;

class FieldValidationStatusPGREnumV1
{
    public OK = 'OK';
    public UNKNOWN_ERROR = 'UNKNOWN_ERROR';
    public DB_ERROR = 'DB_ERROR';
    public DONT_MATCH_DICTIONARY = 'DONT_MATCH_DICTIONARY';
    public DONT_MATCH_PATTERN = 'DONT_MATCH_PATTERN';
    public VALUE_EMPTY = 'VALUE_EMPTY';
    public VALUE_ZERO = 'VALUE_ZERO';
    public VALUE_OUT_OF_RANGE = 'VALUE_OUT_OF_RANGE';
    public VALUE_INCORRECT = 'VALUE_INCORRECT';
    public UNKNOWN_RDB_ERROR = 'UNKNOWN_RDB_ERROR';
    public DUPLICATED_KEY = 'DUPLICATED_KEY';
}
