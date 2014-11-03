<?php
namespace WorldOfPannotiaTest\Tools;

use WorldOfPannotia\Tools\Dice;
use WorldOfPannotia\Tools\DiceRoller;
use WorldOfPannotiaTest\TestCase;


/**
 * @coversDefaultClass WorldOfPannotia\Tools\DiceRoller
 */
class DiceRollerTest extends TestCase
{
    /**
     * @var DiceRoller
     */
    private $roller;

    protected function setUp()
    {
        $this->roller = new DiceRoller();

        // Use the same seed all the time so we can actually assert die rolls
        $this->roller->setDefaultSeed(1234567890)
                     ->clear(DiceRoller::CLEAR_EVERYTHING);
    }

    public function singleDieRollDataProvider()
    {
        return array(
            array(6, 1, 0, '', Dice::SHOW_FULL_RESULT, '1d6 (4) = 4'),
            array(6, 1, 0, '', Dice::SHOW_TOTAL_ONLY, 4),
            array(4, 1, 0, '', Dice::SHOW_FULL_RESULT, '1d4 (3) = 3'),
            array(4, 1, 0, '', Dice::SHOW_TOTAL_ONLY, 3),
        );
    }

    /**
     * @dataProvider singleDieRollDataProvider
     * @covers ::roll()
     */
    public function testSingleDieRoll($dieType, $qty, $modifier, $label, $output, $expectation)
    {
        $result = $this->roller->addDice($qty, $dieType, $modifier, $label)
                               ->roll($output);

        $this->assertEquals($expectation, $result);
    }
}
