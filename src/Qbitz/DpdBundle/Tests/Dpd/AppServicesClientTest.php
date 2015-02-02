<?php

namespace Qbitz\DpdBundle\Tests\Dpd;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use Qbitz\DpdBundle\Dpd\Data as Data;

class AppServicesClientTest extends WebTestCase {

    private function getDpdClient() {
        static $dpdClient = null;
        if(!$dpdClient) {
            $dpdClient = static::createClient()->getContainer()->get('qbitz.dpd.appservices');
        }
        return $dpdClient;
    }

    public function testConfigAndConnection() {
        $dpdClient = $this->getDpdClient();

        $this->assertInstanceOf('\Qbitz\DpdBundle\Dpd\AppServicesClient', $dpdClient);

        $this->assertCount(2, $dpdClient->getFunctions());
    }

    public function testImportPackages() {
        $parcel   = Data\OpenUMLFe\Parcel::create(0.1);
        $sender   = Data\OpenUMLFe\Address::create(null, 'Maszyna.pl', 'ul. Rzemieślnicza 1 p 213', 'Kraków', '30363', 'PL');
        $receiver = Data\OpenUMLFe\Address::create(null, 'DPD Polska Sp. Z o.o.', 'ul. Płk. Dąbka 22 a', 'Kraków', '30732', 'PL');
        $customer = Data\OpenUMLFe\Address::create(null, null, null, null, null, null, 1495);
        $pkg = Data\OpenUMLFe\Package::create('asdf12345'.rand())
                                     ->setSender($sender)
                                     ->setReceiver($receiver)
                                     ->setCustomer($customer)
                                     ->addParcel($parcel);
        $pkg->payerType = 'THIRD_PARTY';
        $pkg->thirdPartyFID = 1495;

        $param = Data\OpenUMLFeV1::create()->addPackage($pkg);

        $resp = $this->getDpdClient()->importPackages($param);

        $this->assertEquals('OK', $resp->StatusInfo->Status);

        $this->assertStringStartsWith("APP/CRIN/", $resp->Packages[0]->OrderNumber);
    }

}
