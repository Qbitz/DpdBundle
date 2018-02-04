<?php

namespace Qbitz\DpdBundle\Dpd\Data\OpenUMLFe;

use JMS\Serializer\Annotation as Serial;
use JMS\Serializer\Annotation\XmlRoot;

/** 
  *  @Serial\XmlRoot("COD") 
  */
class Cod {
    /**
     * @Serial\SerializedName("Amount")
     * @Serial\Type("double")     
     */
    public $amount;
    /**
     * @Serial\SerializedName("Currency")
     * @Serial\Type("string")
     */
    public $currency;
    
    public function __construct($amount = null, $currency = null) {
        $this->amount = $amount;
        $this->currency = $currency;        
    }

    public function setAmount($amount) {
        $this->amount = $amount;

        return $this;
    }

    public function setCurrency($currency) {
        $this->currency = $currency;

        return $this;
    }

    
}
