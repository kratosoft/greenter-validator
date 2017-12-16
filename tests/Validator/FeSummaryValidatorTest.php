<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 19/07/2017
 * Time: 10:55 AM
 */

namespace Tests\Greenter\Validator;

use Greenter\Model\Sale\Document;
use Greenter\Model\Summary\Summary;
use Greenter\Model\Summary\SummaryDetail;

class FeSummaryValidatorTest extends \PHPUnit_Framework_TestCase
{
    use ValidatorTrait;

    public function testValidateSummary()
    {
        $summary = $this->getSummary();
        $validator = $this->getValidator();
        $errors = $validator->validate($summary);

        if ($errors->count() > 0) {
            var_dump($errors);
        }
        $this->assertEquals(0, count($errors));
    }

    public function testNotValidateSummary()
    {
        $summary = $this->getSummary();
        $summary->setFecResumen(null);

        $validator = $this->getValidator();
        $errors = $validator->validate($summary);

        $this->assertEquals(1, count($errors));
    }

    private function getSummary()
    {
        $detiail1 = new SummaryDetail();
        $detiail1->setTipoDoc('03')
            ->setSerieNro('B001-1')
            ->setTotal(800)
            ->setEstado('1')
            ->setClienteTipo('1')
            ->setClienteNro('456688')
            ->setMtoOperGravadas(20.555)
            ->setMtoOperInafectas(24.4)
            ->setMtoOperExoneradas(50)
            ->setMtoOtrosTributos(12.32)
            ->setMtoOtrosCargos(5)
            ->setMtoIGV(3.6)
            ->setMtoISC(0);

        $detiail2 = new SummaryDetail();
        $detiail2->setTipoDoc('07')
            ->setSerieNro('B301-4')
            ->setEstado('1')
            ->setDocReferencia((new Document())
            ->setTipoDoc('03')
            ->setNroDoc('B001-2'))
            ->setTotal(200)
            ->setMtoOperGravadas(40)
            ->setMtoOperExoneradas(30)
            ->setMtoOperInafectas(120)
            ->setMtoIGV(0)
            ->setMtoISC(2.8);

        $sum = new Summary();
        $sum->setFecGeneracion(new \DateTime())
            ->setFecResumen(new \DateTime())
            ->setCompany($this->getCompany())
            ->setCorrelativo('001')
            ->setDetails([$detiail1, $detiail2]);

        return $sum;
    }
}