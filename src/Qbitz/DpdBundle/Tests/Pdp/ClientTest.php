<?php

namespace Qbitz\DpdBundle\Tests\Dpd;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use Qbitz\DpdBundle\Dpd\Data as Data;

class BrowserTest extends WebTestCase {

    private function getDpdClient() {
        static $dpdClient = null;
        if(!$dpdClient) {
            $dpdClient = static::createClient()->getContainer()->get('qbitz.dpd');
        }
        return $dpdClient;
    }

    public function testConfigAndConnection() {
        $dpdClient = $this->getDpdClient();

        $this->assertInstanceOf('\Qbitz\DpdBundle\Dpd\Client', $dpdClient);

        $this->assertCount(12, $dpdClient->getFunctions());
    }

    public function testFindPostalCode() {
        $resp = $this->getDpdClient()->findPostalCode('30527');

        $this->assertInstanceOf('\Qbitz\DpdBundle\Dpd\Data\PostalCode\FindPostalCodeResponseV1', $resp);
        $this->assertEquals('OK', $resp->status);

        $resp = $this->getDpdClient()->findPostalCode('66666', 'AA');
        $this->assertEquals('NONEXISTING_COUNTRY_CODE', $resp->status);

        $resp = $this->getDpdClient()->findPostalCode('66666', 'PL');
        $this->assertEquals('NONEXISTING_POSTAL_CODE', $resp->status);

        $resp = $this->getDpdClient()->findPostalCode('666666', 'DE');
        $this->assertEquals('WRONG_POSTAL_PATTERN', $resp->status);
    }

    public function testCourierAvailability() {
        $resp = $this->getDpdClient()->getCourierOrderAvailability('30527');

        $this->assertInstanceOf('\Qbitz\DpdBundle\Dpd\Data\Courier\GetCourierOrderAvailabilityResponseV1', $resp);
        $this->assertEquals('OK', $resp->status);

        // $resp = $this->getDpdClient()->findPostalCode('52101', 'HN');
        // $this->assertEquals('RANGE_NOT_FOUND', $resp->status);

        $resp = $this->getDpdClient()->findPostalCode('66666', 'AA');
        $this->assertEquals('NONEXISTING_COUNTRY_CODE', $resp->status);

        $resp = $this->getDpdClient()->findPostalCode('66666', 'PL');
        $this->assertEquals('NONEXISTING_POSTAL_CODE', $resp->status);

        $resp = $this->getDpdClient()->findPostalCode('666666', 'DE');
        $this->assertEquals('WRONG_POSTAL_PATTERN', $resp->status);
    }

    private function getSessionInfo() {
        $parcel   = Data\OpenUMLFe\Parcel::create(0.3);
        $sender   = Data\OpenUMLFe\Address::create(null, 'Maszyna.pl', 'ul. Rzemieślnicza 1 p 213', 'Kraków', '30363', 'PL');
        $receiver = Data\OpenUMLFe\Address::create(null, 'DPD Polska Sp. Z o.o.', 'ul. Płk. Dąbka 22 a', 'Kraków', '30732', 'PL', 1495);
        $pkg = Data\OpenUMLFe\Package::create('asdf12345'.rand())
                                     ->setSender($sender)
                                     ->setReceiver($receiver)
                                     ->addParcel($parcel);
        $pkg->payerType = 'RECEIVER';

        $param = Data\OpenUMLFeV1::create()->addPackage($pkg);

        $resp = $this->getDpdClient()->generatePackagesNumbers($param, Data\PkgNumsGenerationPolicyV1::STOP_ON_FIRST_ERROR);
        $this->assertInstanceOf('\Qbitz\DpdBundle\Dpd\Data\PackageNumber\PackagesGenerationResponseV1', $resp);
        $this->assertEquals('OK', $resp->packages->parcels->status);

        return $resp;
    }

    private function getDocuments($sess) {
        $parc = new Data\Document\ParcelDSPV1();
        $parc->parcelId = $sess->packages->parcels->parcelId;

        $pkg = new Data\Document\PackageDSPV1();
        $pkg->packageId = $sess->packages->packageId;
        $pkg->searchKey = $sess->packages->reference;
        $pkg->parcels = array( $parc );

        $params = new Data\Document\DPDServicesParamsV1();
        $params->policy = Data\Document\PolicyDSPEnumV1::STOP_ON_FIRST_ERROR;
        $params->session = new Data\Document\SessionDSPV1();
        $params->session->sessionId = $sess->sessionId;
        $params->session->packages = array( $pkg );
        $params->session->sessionType = Data\Document\SessionTypeDSPEnumV1::DOMESTIC;
        $params->pickupAddress = Data\Document\PickupAddressDSPV1::create('Przemysław Nowakowski', 'Maszyna.pl', 'ul. Rzemieślnicza 1 p 213', 'Kraków', '30363', 'PL');

        $resp = $this->getDpdClient()->generateSpedLabels($params, Data\OutputDocFormatDSPEnumV1::PDF, Data\OutputDocPageFormatDSPEnumV1::A4);
        $this->assertInstanceOf('\Qbitz\DpdBundle\Dpd\Data\Document\DocumentGenerationResponseV1', $resp);

        $fn = $this->getDpdClient()->saveFile($resp);
        $this->assertFileExists($this->getDpdClient()->getOutputDir().'/'.$fn);

        $resp2 = $this->getDpdClient()->generateProtocol($params, Data\OutputDocFormatDSPEnumV1::PDF, Data\OutputDocPageFormatDSPEnumV1::A4);
        $this->assertInstanceOf('\Qbitz\DpdBundle\Dpd\Data\Document\DocumentGenerationResponseV1', $resp2);

        $fn = $this->getDpdClient()->saveFile($resp2);
        $this->assertFileExists($this->getDpdClient()->getOutputDir().'/'.$fn);
    }

    public function testPickupCalls() {
        $sess = $this->getSessionInfo();

        $this->getDocuments($sess);

        $params = Data\PickupCallV3\DpdPickupCallParamsV3::createInsert('2014-09-10', '13:00', '16:00'); // 13 ; 14 ; 15 + 180

        $det = new Data\PickupCallV3\PickupCallSimplifiedDetailsDPPV1();
        $det->pickupPayer = Data\PickupCallV3\PickupPayerDPPV1::create(1495, 'Maszyna.pl', 'Maszyna.pl');
        $det->pickupCustomer = Data\PickupCallV3\PickupCustomerDPPV1::create('Przemysław Nowakowski', 'Przemysław Nowakowski', '793795415');
        $det->pickupSender = Data\PickupCallV3\PickupSenderDPPV1::create('Przemysław Nowakowski', 'Przemysław Nowakowski', 'ul. Rzemieślnicza 1 p 213', 'Kraków', '30363', '793795415');
        $det->packagesParams = Data\PickupCallV3\PickupPackagesParamsDPPV1::createSingleDOX();

        $params->pickupCallSimplifiedDetails = $det;

        $resp = $this->getDpdClient()->packagesPickupCall($params);
        $this->assertInstanceOf('\Qbitz\DpdBundle\Dpd\Data\PickupCallV3\PackagesPickupCallResponseV3', $resp);

        $this->assertEquals('OK', $resp->statusInfo->status);

        $this->assertStringStartsWith(date('Ymd'), $resp->orderNumber);
    }

}
