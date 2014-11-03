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
    private $defaultSeed = null;

    public function __construct()
    {
    }

    public function setDefaultSeed($seed)
    {
        $this->defaultSeed = $seed;
        return $this;
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

    public function rollMacro($macro, $outputType = self::SHOW_FULL_RESULT)
    {
        $tmpDice = $this->dice;
        $this->dice = unserialize($this->macros[$macro]);
        $output = $this->roll($outputType);
        $this->dice = $tmpDice;
        return $output;
    }

    public function addDice($qty, $type, $modifier = 0, $label = '')
    {
        $die = new Dice($type, $qty, $modifier, $label);
        if (!is_null($this->defaultSeed)) {
            $die->setSeed($this->defaultSeed);
        }
        $this->dice[] = $die;
        return $this;
    }

    public function loadMacro($string, $name)
    {
        $this->macros[$name] = unserialize($string);
        return $this;
    }

    public function loadFromString($string)
    {
        $n = substr($string, 0, strpos($string, 'd'));
        $string = substr($string, strpos($string, 'd') + 1);

        $type = '';
        while (is_numeric(substr($string, 0, 1))) {
            $type .= substr($string, 0, 1);
            $string = substr($string, 1);
        }
        $modifier = $string;

        $this->addDice($n, $type, $modifier);

        return $this;
    }

    public function saveMacro($name)
    {
        $this->macros[$name] = serialize($this->dice);
        return $this;
    }

    public function getMacro($name)
    {
        if (empty($this->macros[$name])) {
            return "Macro \"{$name}\" is not defined, or it is empty.";
        }
        return $this->macros[$name];
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
        return $this;
    }
}