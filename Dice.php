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

    public function __construct($type, $qty, $modifier, $label = '')
    {
        $this->dieType  = $type;
        $this->quantity = $qty;
        $this->modifier = $modifier;
        $this->label    = $label;

        $this->seed();
    }

    public function roll($outputType = self::SHOW_FULL_RESULT)
    {
        $output = $this->quantity . 'd' . $this->dieType;
        if ($this->modifier > 0) {
            $output .= '+' . $this->modifier;
        }
        $output .= ' ' . $this->label . ' (';
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

    private function seed()
    {
        if (function_exists('mt_srand')) {
            mt_srand();
        } else {
            srand();
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