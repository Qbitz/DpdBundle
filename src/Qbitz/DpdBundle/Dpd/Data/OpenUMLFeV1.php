<?php

namespace Qbitz\DpdBundle\Dpd\Data;

use JMS\Serializer\Annotation as Serial;

/**
 * @Serial\XmlRoot("Packages")
 */
class OpenUMLFeV1 {

    /**
     * @Serial\XmlList(inline = true, entry = "Package")
     */
    public $packages;

    public static function create() {
        return new OpenUMLFeV1();
    }

    public function addPackage(OpenUMLFe\Package $package) {
        if(!is_array($this->packages)) {
            $this->packages = array();
        }

        array_push($this->packages, $package);

        return $this;
    }
}
