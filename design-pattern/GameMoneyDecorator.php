<?php

class GameMoneyDecorator
{
    const TYPE_PLATINUM = 'P';
    const TYPE_GOLD     = 'G';
    const TYPE_SILVER   = 'S';
    const TYPE_COPPER   = 'C';

    const RATION_IN_COPPER = [
        self::TYPE_PLATINUM => 1000,
        self::TYPE_GOLD     => 100,
        self::TYPE_SILVER   => 10,
        self::TYPE_COPPER   => 1,
    ];

    const TYPE_TO_STRING = [
        self::TYPE_PLATINUM => 'PM',
        self::TYPE_GOLD     => 'GM',
        self::TYPE_SILVER   => 'SM',
        self::TYPE_COPPER   => 'CM',
    ];

    private $amount = 0;

    public function __construct($amountInCopper)
    {
        $this->amount = $amountInCopper;
    }

    public function test($amount, $type)
    {
        $ratio = self::RATION_IN_COPPER[$type];
        $count = floor($amount / $ratio);

        return [$count, $amount - $count * $ratio];
    }

    public function __toString()
    {
        $string = '';

        $amount = $this->amount;
        foreach (self::RATION_IN_COPPER as $type => $ratio) {
            list($count, $amount) = $this->test($amount, $type);
            if ($count) {
                $string .= ' ' . $count . self::TYPE_TO_STRING[$type];
            }
        }

        return ltrim($string);
    }
}

/* ------------------------------------------------------------------------------------------------------------------ */

$decorator = new GameMoneyDecorator(1024);
echo $decorator; # 1PM 2SM 4CM
