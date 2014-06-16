<?php

namespace Qbitz\DpdBundle\Dpd\Data\PickupCallV2;

class StatusInfoPCRV2
{
    public $status;
    public $errorDetails;

    const OK = 'OK';
    const BOK_WS_ERROR = 'BOK_WS_ERROR';
    const BOK_WS_UNKNOWN_ERROR = 'BOK_WS_UNKNOWN_ERROR';
    const BOK_WS_NO_PRIVILEGES = 'BOK_WS_NO_PRIVILEGES';
    const INCORRECT_STATUS = 'INCORRECT_STATUS';
    const EMPTY_DATA = 'EMPTY_DATA';
    const BOK_WS_TRY_AGAIN_LATER = 'BOK_WS_TRY_AGAIN_LATER';
    const VALIDATION_ERROR = 'VALIDATION_ERROR';
    const ORDER_CANCEL_DENIED = 'ORDER_CANCEL_DENIED';
}
