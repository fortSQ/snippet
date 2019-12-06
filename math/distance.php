<?php

class Point
{
    private $x;
    private $y;

    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function getX()
    {
        return $this->x;
    }

    public function getY()
    {
        return $this->y;
    }
}

class Distance
{
    private $a;
    private $b;

    public function __construct(Point $a, Point $b)
    {
        $this->a = $a;
        $this->b = $b;
    }

    private function getDeltaX()
    {
        return $this->a->getX() - $this->b->getX();
    }

    private function getDeltaY()
    {
        return $this->a->getY() - $this->b->getY();
    }

    public function getEuclid()
    {
        return ceil(sqrt(pow($this->getDeltaX(), 2) + pow($this->getDeltaY(), 2)));
    }

    public function getL1()
    {
        return abs($this->getDeltaX()) + abs($this->getDeltaY());
    }

    public function getChebyshev()
    {
        return max(abs($this->getDeltaX()), abs($this->getDeltaY()));
    }

    public function printAll()
    {
        return "Euclid:\t\t{$this->getEuclid()}<br>L1:\t\t{$this->getL1()}<br>Chebyshev:\t{$this->getChebyshev()}";
    }
}

/* ------------------------------------------------------------------------------------------------------------------ */

$a = new Point(70, 40);
$b = new Point(330, 228);

$dist = new Distance($a, $b);

echo '<pre>';
print_r($dist->printAll());
echo '</pre>';
