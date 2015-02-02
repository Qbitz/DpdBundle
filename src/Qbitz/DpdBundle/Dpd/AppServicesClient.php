<?php

namespace Qbitz\DpdBundle\Dpd;

use JMS\Serializer\SerializationContext;

class AppServicesClient extends BaseClient {

    public function importPackages(Data\OpenUMLFeV1 $openUMLFXV2) {
        $resp = $this->invokeRemote('importPackagesXV1', array(
            'openUMLFXV2' => $this->getSerializer()->serialize($openUMLFXV2, 'xml'),
            'pkgImportPolicyV1' => 'IGNORE_ERRORS'
        ));

        return $this->getSerializer()->deserialize($resp->return, 'Qbitz\DpdBundle\Dpd\Data\PackagesImport\PackagesImportResponse', 'xml');
    }

}
