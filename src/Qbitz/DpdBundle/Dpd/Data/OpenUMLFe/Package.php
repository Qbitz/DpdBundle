<?php

namespace Qbitz\DpdBundle\Dpd\Data\OpenUMLFe;

class Package {
    public $payerType;
    public $receiver;
    public $sender;
//    public $thirdPartyFID;
    public $reference;
    public $ref1;
    public $ref2;
    public $ref3;
    public $services;
    public $parcels;

    public function __construct($reference = null, $thirdPartyFID = null) {
        $this->reference = $reference;
        $this->ref1      = $reference;
//        $this->thirdPartyFID = $thirdPartyFID;
    }

    public static function create($reference = null, $thirdPartyFID = null) {
        return new Package($reference, $thirdPartyFID);
    }

    public function setSender(Address $sender) {
        $this->sender = $sender;

        return $this;
    }

    public function setReceiver(Address $receiver) {
        $this->receiver = $receiver;

        return $this;
    }

    public function addParcel(Parcel $parcel) {
        if(!is_array($this->parcels)) {
            $this->parcels = array();
        }

        array_push($this->parcels, $parcel);

        return $this;
    }
}
