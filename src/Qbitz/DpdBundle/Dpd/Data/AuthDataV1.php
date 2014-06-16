<?php

namespace Qbitz\DpdBundle\Dpd\Data;

class AuthDataV1
{
    public $login;
    public $masterFid;
    public $password;

    public function __construct($login = null, $masterFid = null, $password = null) {
        $this->login     = $login;
        $this->masterFid = $masterFid;
        $this->password  = $password;
    }
}
