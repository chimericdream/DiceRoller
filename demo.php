<?php
require_once dirname(__FILE__) . '/DiceRoller.php';

use WorldOfPannotia\Tools\DiceRoller;

$roller = new DiceRoller();

$roller->addDice(1, 6, 0, 'fire'); // 1d6+6 fire
$roller->addDice(10, 10);          // 10d10
$roller->addDice(1, 8, 4);         // 1d8+4

echo $roller->roll(DiceRoller::SHOW_FULL_RESULT) . '<br>';
echo $roller->roll(DiceRoller::SHOW_FULL_RESULT) . '<br>';

$roller->rollMacro('test', DiceRoller::SHOW_FULL_RESULT);
$roller->rollMacro('test', DiceRoller::SHOW_TOTAL_ONLY);

$roller->loadMacro('');
$roller->saveMacro();
$roller->getMacro();

$roller->clear(DiceRoller::CLEAR_CURRENT_DICE);
$roller->clear(DiceRoller::CLEAR_MACROS_ONLY);
$roller->clear(DiceRoller::CLEAR_EVERYTHING);
