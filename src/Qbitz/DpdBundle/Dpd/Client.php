<?php

namespace Qbitz\DpdBundle\Dpd;

class Client {

    private $wsdl;
    private $login;
    private $password;
    private $fid;
    private $outputDir;

    public function __construct($wsdl, $login, $password, $fid, $outputDir) {
        $this->wsdl      = $wsdl;
        $this->login     = $login;
        $this->password  = $password;
        $this->fid       = $fid;
        $this->outputDir = $outputDir;
    }

    private function getConnection() {
        static $connection = null;
        if(!$connection) {
            $connection = new \SoapClient($this->wsdl, array(
                'cache_wsdl' => WSDL_CACHE_NONE,
                'classmap' => array(
                    'findPostalCodeResponseV1' => 'Qbitz\DpdBundle\Dpd\Data\PostalCode\FindPostalCodeResponseV1',
                    'getCourierOrderAvailabilityResponseV1' => 'Qbitz\DpdBundle\Dpd\Data\Courier\GetCourierOrderAvailabilityResponseV1',
                    'courierOrderAvailabilityRangeV1' => 'Qbitz\DpdBundle\Dpd\Data\Courier\CourierOrderAvailabilityRangeV1',
                    'packagesGenerationResponseV1' => 'Qbitz\DpdBundle\Dpd\Data\PackageNumber\PackagesGenerationResponseV1',
                    'packagePGRV1' => 'Qbitz\DpdBundle\Dpd\Data\PackageNumber\PackagePGRV1',
                    'invalidFieldPGRV1' => 'Qbitz\DpdBundle\Dpd\Data\PackageNumber\InvalidFieldPGRV1',
                    'parcelPGRV1' => 'Qbitz\DpdBundle\Dpd\Data\PackageNumber\ParcelPGRV1',
                    'documentGenerationResponseV1' => 'Qbitz\DpdBundle\Dpd\Data\Document\DocumentGenerationResponseV1',
                    'sessionDGRV1' => 'Qbitz\DpdBundle\Dpd\Data\Document\SessionDGRV1',
                    'statusInfoDGRV1' => 'Qbitz\DpdBundle\Dpd\Data\Document\StatusInfoDGRV1',
                    'packageDGRV1' => 'Qbitz\DpdBundle\Dpd\Data\Document\PackageDGRV1',
                    'parcelDGRV1' => 'Qbitz\DpdBundle\Dpd\Data\Document\ParcelDGRV1',
                    'packagesPickupCallResponseV3' => 'Qbitz\DpdBundle\Dpd\Data\PickupCallV3\PackagesPickupCallResponseV3',
                    'statusInfoPCRV2' => 'Qbitz\DpdBundle\Dpd\Data\PickupCallV2\StatusInfoPCRV2',
                    'errorDetailsPCRV2' => 'Qbitz\DpdBundle\Dpd\Data\PickupCallV2\ErrorDetailsPCRV2'
                )
            ));
        }
        return $connection;
    }

    private function getAuthData() {
        return new Data\AuthDataV1($this->login, $this->fid, $this->password);
    }

    private function authenticateRequest(array $request) {
        $request['authDataV1'] = $this->getAuthData();

        return $request;
    }

    private function invokeRemote($method, array $arguments) {
        return $this->getConnection()->__soapCall( $method, array($this->authenticateRequest($arguments)) );
    }

    public function getOutputDir() {
        return $this->outputDir;
    }

    public function getFunctions() {
        return $this->getConnection()->__getFunctions();
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
