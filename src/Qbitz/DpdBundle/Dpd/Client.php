<?php

namespace Qbitz\DpdBundle\Dpd;

/*
    Formaty:

OpenUMLFe

PackagesGenerationResponseV1 generatePackagesNumbersV1(OpenUMLFeV1 openUMLV1, PkgNumsGenerationPolicyV1 policyV1, AuthDataV1 authDataV1)

+    PackagesGenerationResponseV1
+        PackagePGRV1
+        InvalidFieldPGRV1
+        ValidationStatusPGREnumV1          // static : const only
+        FieldValidationStatusPGREnumV1     // static : const only
+        ParcelPGRV1

DocumentGenerationResponseV1 generateSpedLabelsV1(DPDServicesParamsV1 dpdServicesParamsV1, OutputDocFormatDSPEnumV1 outputDocFormatV1, OutputDocPageFormatDSPEnumV1 outputDocPageFormatV1, AuthDataV1 authDataV1)
DocumentGenerationResponseV1 generateProtocolV1(DPDServicesParamsV1 dpdServicesParamsV1, OutputDocFormatDSPEnumV1 outputDocFormatV1, OutputDocPageFormatDSPEnumV1 outputDocPageFormatV1, AuthDataV1 authDataV1)

    DPDServicesParamsV1
        PolicyDSPEnumV1                    // static : const only
        PickupAddressDSPV1
        SessionDSPV1
        PackageDSPV1
        ParcelDSPV1
        SessionTypeDSPEnumV1               // static : const only
    DocumentGenerationResponseV1
        SessionDGRV1
        PackageDGRV1
        ParcelDGRV1
        StatusInfoDGRV1
        StatusDGREnumV1                    // static : const only

PackagesPickupCallResponseV1 packagesPickupCallV1 (DPDPickupParamsV1 pickupParamsV1, AuthDataV1 authDataV1)

    DPDPickupCallParamsV1
        PolicyDPPEnumV1                    // static : const only
        ContactInfoDPPV1
        ProtocolDPPV1
    PackagesPickupCallResponseV1
        ProtocolPCRV1
        StatusInfoPCRV1
        StatusPCREnumV1                    // static : const only

PackagesPickupCallResponseV2 packagesPickupCallV2 (DpdPickupCallParamsV2 dpdPickupParamsV2, AuthDataV1 authDataV1)

    DpdPickupCallParamsV2
    PackagesPickupCallResponseV2
        StatusInfoPCRV2
        ErrorDetailsPCRV2

PackagesPickupCallResponseV3 packagesPickupCallV3 (DpdPickupCallParamsV3 dpdPickupParamsV3, AuthDataV1 authDataV1)

    DpdPickupCallParamsV3
        PickupCallOperationTypeDPPEnumV1   // static : const only
        PickupCallUpdateModeDPPEnumV1      // static : const only
        PickupCallOrderTypeDPPEnumV1       // static : const only
        PickupCallSimplifiedDetailsDPPV1
        PickupPayerDPPV1
        PickupCustomerDPPV1
        PickupSenderDPPV1
        PickupPackagesParamsDPPV1
    PackagesPickupCallResponseV3

ImportDeliveryBusinessEventResponseV1 importDeliveryBusinessEventV1( DPDParcelBusinessEventV1 dpdParcelBusinessEventV1, AuthDataV1 authDataV1))

    DPDParcelBusinessEventV1
        DPDParcelBusinessEventDataV1
    ImportDeliveryBusinessEventResponseV1
        ImportDeliveryBusinessEventStatusEnumV1 // static : const only

+ FindPostalCodeResponseV1 findPostalCodeV1(PostalCodeV1 postalCodeV1, AuthDataV1 authDataV1)

+    PostalCodeV1
+    FindPostalCodeResponseV1

+ GetCourierOrderAvailabilityResponseV1 getCourierOrderAvailabilityV1(SenderPlaceV1 senderPlaceV1, AuthDataV1 authDataV1)

+    SenderPlaceV1
+    GetCourierOrderAvailabilityResponseV1
+        CourierOrderAvailabilityRangeV1

+ Misc

+    AuthDataV1
+    OutputDocFormatDSPEnumV1       // static : const only
+    OutputDocPageFormatDSPEnumV1   // static : const only
+    PkgNumsGenerationPolicyV1



*/

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
                    'errorDetailsPCRV2' => 'Qbitz\DpdBundle\Dpd\Data\PickupCallV2\ErrorDetailsPCRV2',
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
