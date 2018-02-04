<?php

namespace Qbitz\DpdBundle\Dpd\Data\OpenUMLFe;

use JMS\Serializer\Annotation as Serial;

/**
 * @Serial\XmlRoot("Service")
 */
class Service {
    /**
     * @Serial\SerializedName("COD")
     */
    public $cod ;

    public function __construct() {
       
        
    }

    public function setCod(Cod $cod) {
        $this->cod = $cod;

        return $this;
    }
    
}
