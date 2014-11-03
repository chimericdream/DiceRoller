<?php
namespace WorldOfPannotiaTest\Tools;

use WorldOfPannotia\Tools\Dice;
use WorldOfPannotiaTest\TestCase;

/**
 * @coversDefaultClass WorldOfPannotia\Tools\Dice
 */
class DiceTest extends TestCase
{
    /**
     * @var Dice
     */
    private $dice;

    protected function setUp()
    {
        $this->dice = new Dice();

        // Use the same seed all the time so we can actually assert die rolls
        $this->dice->setSeed(1234567890);
    }

    public function dieRollDataProvider()
    {
        return array(
            array(6, 1, 0, '', Dice::SHOW_FULL_RESULT, array('output' => '1d6 (4)', 'total' => 4)),
            array(6, 1, 0, '', Dice::SHOW_TOTAL_ONLY, 4),
            array(4, 1, 0, '', Dice::SHOW_FULL_RESULT, array('output' => '1d4 (3)', 'total' => 3)),
            array(4, 1, 0, '', Dice::SHOW_TOTAL_ONLY, 3),
        );
    }

    /**
     * @dataProvider dieRollDataProvider
     * @covers ::roll()
     */
    public function testDieRoll($dieType, $qty, $modifier, $label, $output, $expectation)
    {
        $result = $this->dice->setDieType($dieType)
                             ->setQuantity($qty)
                             ->setModifier($modifier)
                             ->setLabel($label)
                             ->roll($output);

        $this->assertEquals($expectation, $result);
    }
}
