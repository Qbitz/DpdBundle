<?php

namespace Qbitz\DpdBundle\Dpd;

use JMS\Serializer\Serializer;

abstract class BaseClient {

    private $wsdl;
    private $login;
    private $password;
    private $fid;
    private $serializer;

    public function __construct(Serializer $serializer, $wsdl, $login, $password, $fid) {
        $this->serializer = $serializer;
        $this->wsdl      = $wsdl;
        $this->login     = $login;
        $this->password  = $password;
        $this->fid       = $fid;
    }

    protected function getConnection() {
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

    protected function getAuthData() {
        return new Data\AuthDataV1($this->login, $this->fid, $this->password);
    }

    protected function authenticateRequest(array $request) {
        $request['authDataV1'] = $this->getAuthData();

        return $request;
    }

    protected function invokeRemote($method, array $arguments) {
        return $this->getConnection()->__soapCall( $method, array($this->authenticateRequest($arguments)) );
    }

    protected function getSerializer() {
        return $this->serializer;
    }

    public function getFunctions() {
        return $this->getConnection()->__getFunctions();
    }


}
