<?php

namespace App\Core;

abstract class AbstractRobot
{
    private $location;
    private $health;

    public function __construct(
        Coordinate $location,
        int $health
    ) {
        $this->location = $location;
        $this->health = $health;
    }

    public function getLocation(): Coordinate
    {
        return $this->location;
    }

    public function setLocation(Coordinate $location): void
    {
        $this->location = $location;
    }

    public function getHealth(): int
    {
        return $this->health;
    }
}
