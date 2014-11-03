<?php
namespace WorldOfPannotia\Tools;

class Dice
{
    const SHOW_FULL_RESULT = 1;
    const SHOW_TOTAL_ONLY  = 2;

    private $dieType  = -1;
    private $quantity = -1;
    private $modifier = 0;
    private $label    = '';

    public function __construct($type = -1, $qty = -1, $modifier = 0, $label = '')
    {
        $this->dieType  = $type;
        $this->quantity = $qty;
        $this->modifier = $modifier;
        $this->label    = $label;

        $this->seed();
    }

    public function getDieType()
    {
        return $this->dieType;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getModifier()
    {
        return $this->modifier;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function setDieType($dieType)
    {
        $this->dieType = $dieType;
        return $this;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function setModifier($modifier)
    {
        $this->modifier = $modifier;
        return $this;
    }

    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    public function setSeed($seed)
    {
        $this->seed($seed);
        return $this;
    }

    public function roll($outputType = self::SHOW_FULL_RESULT)
    {
        $output = $this->quantity . 'd' . $this->dieType;
        if ($this->modifier > 0) {
            $output .= '+' . $this->modifier;
        }
        if (!empty($this->label)) {
            $output .= ' ' . $this->label;
        }
        $output .= ' (';
        $total  = 0;
        for ($i = 1; $i <= $this->quantity; $i++) {
            $output .= ($i > 1) ? '+' : '';
            $dieRoll = $this->rnd(1, $this->dieType);

            $total  += $dieRoll;
            $output .= $dieRoll;
        }
        $total += $this->modifier;
        if ($this->modifier > 0) {
            $output .= '+' . $this->modifier;
        }
        $output .= ')';

        if ($outputType == self::SHOW_FULL_RESULT) {
            return array(
                'output' => $output,
                'total'  => $total,
            );
        } else {
            return $total;
        }
    }

    private function seed($seed = null)
    {
        if (function_exists('mt_srand')) {
            mt_srand($seed);
        } else {
            srand($seed);
        }
    }

    private function rnd($min = 1, $max = 1)
    {
        if (function_exists('mt_rand')) {
            return mt_rand($min, $max);
        } else {
            return rand($min, $max);
        }
    }
}