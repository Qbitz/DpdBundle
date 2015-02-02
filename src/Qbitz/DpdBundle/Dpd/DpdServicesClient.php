<?php

namespace Qbitz\DpdBundle\Dpd;

use JMS\Serializer\Serializer;

class DpdServicesClient extends BaseClient {

    private $outputDir;

    public function __construct(Serializer $serializer, $wsdl, $login, $password, $fid, $outputDir) {
        parent::__construct($serializer, $wsdl, $login, $password, $fid);

        $this->outputDir = $outputDir;
    }

    public function getOutputDir() {
        return $this->outputDir;
    }

    public function saveFile(Data\Document\DocumentGenerationResponseV1 $documentGenerationResponseV1) {
        if(!is_dir($this->outputDir)) {
            mkdir($this->outputDir, 0755, true);
        }

        $fn = microtime().'.pdf';
        file_put_contents($this->outputDir.'/'.$fn, $documentGenerationResponseV1->documentData);

        return $fn;
    }

    public function findPostalCode($zipCode, $countryCode='PL') {
        $resp = $this->invokeRemote('findPostalCodeV1', array(
            'postalCodeV1' => new Data\PostalCode\PostalCodeV1($countryCode, $zipCode)
        ) );

        return $resp->return;
    }

    public function getCourierOrderAvailability($zipCode, $countryCode='PL') {
        $resp = $this->invokeRemote('getCourierOrderAvailabilityV1', array(
            'senderPlaceV1' => new Data\Courier\SenderPlaceV1($countryCode, $zipCode)
        ));

        return $resp->return;
    }

    public function generatePackagesNumbers(Data\OpenUMLFeV1 $openUMLV1, $policyV1) {
        $resp = $this->invokeRemote('generatePackagesNumbersV1', compact(
            'openUMLV1',
            'policyV1'
        ));

        return $resp->return;
    }

    public function generateSpedLabels(Data\Document\DPDServicesParamsV1 $dpdServicesParamsV1, $outputDocFormatV1, $outputDocPageFormatV1) {
        $resp = $this->invokeRemote('generateSpedLabelsV1', compact(
            'dpdServicesParamsV1',
            'outputDocFormatV1',
            'outputDocPageFormatV1'
        ));

        return $resp->return;
    }

    public function generateProtocol(Data\Document\DPDServicesParamsV1 $dpdServicesParamsV1, $outputDocFormatV1, $outputDocPageFormatV1) {
        $resp = $this->invokeRemote('generateProtocolV1', compact(
            'dpdServicesParamsV1',
            'outputDocFormatV1',
            'outputDocPageFormatV1'
        ));

        return $resp->return;
    }

    public function packagesPickupCall(Data\PickupCallV3\DpdPickupCallParamsV3 $dpdPickupParamsV3) {
        $resp = $this->invokeRemote('packagesPickupCallV3', compact(
            'dpdPickupParamsV3'
        ));

        return $resp->return;
    }

}
