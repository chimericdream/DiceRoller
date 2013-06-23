<?php
namespace WorldOfPannotia\Tools;

use WorldOfPannotia\Tools\Dice;

require_once dirname(__FILE__) . '/Dice.php';

class DiceRoller
{
    const SHOW_FULL_RESULT   = Dice::SHOW_FULL_RESULT;
    const SHOW_TOTAL_ONLY    = Dice::SHOW_TOTAL_ONLY;
    const CLEAR_CURRENT_DICE = 1;
    const CLEAR_MACROS_ONLY  = 2;
    const CLEAR_EVERYTHING   = 3;

    private $dice    = array();
    private $macros  = array();

    public function __construct()
    {
    }

    public function roll($outputType = self::SHOW_FULL_RESULT)
    {
        if (empty($this->dice)) {
            // @todo: throw exception here
            return;
        }

        $output = '';
        $total  = 0;
        $i      = 0;
        foreach ($this->dice as $d) {
            $dieRoll = $d->roll($outputType);
            if ($outputType == self::SHOW_FULL_RESULT) {
                if ($i > 0) {
                    $output .= ' + ';
                }
                $output .= $dieRoll['output'];
                $total  += $dieRoll['total'];
            } else {
                $total  += $dieRoll;
            }
            $i++;
        }
        $output .= ' = ' . $total;

        if ($outputType == self::SHOW_FULL_RESULT) {
            return $output;
        } else {
            return $total;
        }
    }

    // @todo: rollMacro()
    public function rollMacro($macro, $outputType = self::SHOW_FULL_RESULT)
    {
        echo "rollMacro({$macro}, {$outputType})<br>\n";
    }

    public function addDice($qty, $type, $modifier = 0, $label = '')
    {
        $this->dice[] = new Dice($type, $qty, $modifier, $label);
    }

    // @todo: loadMacro()
    public function loadMacro($string)
    {
        echo "loadMacro({$string})<br>\n";
    }

    // @todo: saveMacro()
    public function saveMacro()
    {
        echo "saveMacro()<br>\n";
    }

    // @todo: getMacro()
    public function getMacro()
    {
        echo "getMacro()<br>\n";
    }

    public function clear($c = self::CLEAR_CURRENT_DICE)
    {
        if ($c = self::CLEAR_CURRENT_DICE) {
            $this->dice   = array();
        } else if ($c = self::CLEAR_MACROS_ONLY) {
            $this->macros = array();
        } else if ($c = self::CLEAR_EVERYTHING) {
            $this->dice   = array();
            $this->macros = array();
        }
    }
}