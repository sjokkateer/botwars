<?php

namespace App\Core;

use InvalidArgumentException;

class Coordinate
{
    private $x;
    private $y;

    public function __construct(int $x, int $y)
    {
        $this->validateCoordinate($x);
        $this->validateCoordinate($y);

        $this->x = $x - 1;
        $this->y = $y - 1;
    }

    private function validateCoordinate(int $coordinate): void
    {
        if ($coordinate < 1 || $coordinate > 16) {
            throw new InvalidArgumentException("Coordinate values must be between 1 and 16");
        }
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function __toString(): string
    {
        $x = $this->getX() + 1;
        $y = $this->getY() + 1;

        return "$x:$y";
    }
}
