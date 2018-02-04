<?php

namespace Qbitz\DpdBundle\Dpd\Data\OpenUMLFe;

use JMS\Serializer\Annotation as Serial;

/**
 * @Serial\XmlRoot("Package")
 */
class Package {
    /**
     * @Serial\SerializedName("PayerType")
     */
    public $payerType;
    /**
     * @Serial\SerializedName("ThirdPartyFID")
     */
    public $thirdPartyFID;
    /**
     * @Serial\SerializedName("Receiver")
     */
    public $receiver;
    /**
     * @Serial\SerializedName("Sender")
     */
    public $sender;
    /**
     * @Serial\SerializedName("Customer")
     */
    public $customer;
    /**
     * @Serial\SerializedName("Reference")
     */
    public $reference = '';
    /**
     * @Serial\SerializedName("Ref1")
     */
    public $ref1 = '';
    /**
     * @Serial\SerializedName("Ref2")
     */
    public $ref2 = '';
    /**
     * @Serial\SerializedName("Ref3")
     */
    public $ref3 = '';
    /**
     * @Serial\SerializedName("Services")
     */
    public $services = '';
    /**
     * @Serial\SerializedName("Parcels")
     * @Serial\XmlList(entry = "Parcel")
     */
    public $parcels;

    public function __construct($reference = null, $thirdPartyFID = null) {
        $this->reference = $reference;
        $this->ref1      = $reference;
        $this->thirdPartyFID = $thirdPartyFID;
    }

    public static function create($reference = null, $thirdPartyFID = null) {
        return new Package($reference, $thirdPartyFID);
    }

    public function setSender(Address $sender) {
        $this->sender = $sender;

        return $this;
    }

    public function setCustomer(Address $customer) {
        $this->customer = $customer;

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

    public function addServices(Service $service) {
        if(!is_array($this->services)) {
            $this->services = array();
        }

        array_push($this->services, $service);

        return $this;
    }
}
