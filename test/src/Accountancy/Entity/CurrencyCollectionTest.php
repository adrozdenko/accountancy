<?php
/**
 *
 */

namespace Accountancy\Entity;

/**
 * Class CurrencyCollectionTest
 *
 * @package Accountancy\Entity
 */
class CurrencyCollectionTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Successful scenario
     */
    public function testAddCurrency()
    {
        $collection = new CurrencyCollection();

        $c1 = new Currency();
        $c1->setId(1)
           ->setCode('UAH')
           ->setName('Ukrainian Hryvna');

        $c2 = new Currency();
        $c2->setId(2)
           ->setCode('USD')
           ->setName('United States Dollar');

        $collection->addCurrency($c1);
        $this->assertEquals(array($c1), $collection->getCurrencies());

        $collection->addCurrency($c2);
        $this->assertEquals(array($c1, $c2), $collection->getCurrencies());
    }

    /**
     * Ensures hasCurrency returns correct values
     */
    public function testHasCurrency()
    {
        $collection = new CurrencyCollection();

        $collection->setCurrencies(array(
            (new Currency())
                ->setId(1)
                ->setCode('UAH')
                ->setName('Ukrainian Hryvna'),

            (new Currency())
                ->setId(2)
                ->setCode('USD')
                ->setName('United States Dollar'),
        ));

        $this->assertTrue($collection->hasCurrency(1));
        $this->assertTrue($collection->hasCurrency(2));
        $this->assertFalse($collection->hasCurrency(30));
    }
}
