<?php
require_once dirname(__FILE__) . '/../WorldOfPannotia/Tools/DiceRoller.php';

use WorldOfPannotia\Tools\DiceRoller;

$roller = new DiceRoller();

$dieRoll = $roller
                ->addDice(1, 8, 4, 'longsword')
                ->addDice(1, 6, 0, 'fire')
                ->saveMacro('flaming longsword')
                ->clear()
                ->rollMacro('flaming longsword');

echo $dieRoll . '<br>';
