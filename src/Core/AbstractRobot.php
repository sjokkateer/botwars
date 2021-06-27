<?php

namespace App\Core;

abstract class AbstractRobot
{
    public function __construct(
        private Coordinate $location,
        private int $health,
    ) {
    }

    public function getLocation(): Coordinate
    {
        return $this->location;
    }

    public function getHealth(): int
    {
        return $this->health;
    }
}
