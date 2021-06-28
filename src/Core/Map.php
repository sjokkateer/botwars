<?php

namespace App\Core;

class Map
{
    private const WIDTH = 16;
    private const HEIGHT = 16;

    private $mapGrid;

    public function __construct()
    {
        $this->mapGrid = $this->makeGrid();
    }

    private function makeGrid(): array
    {
        $grid = [];

        for ($y = 0; $y < self::HEIGHT; $y++) {
            $grid[] = [];

            for ($x = 0; $x < self::WIDTH; $x++) {
                $grid[$y][] = [];

                if ($this->shouldBeBlocked($x, $y)) {
                    $grid[$y][$x][] = new Block;
                }
            }
        }

        return $grid;
    }

    private function shouldBeBlocked(int $x, int $y): bool
    {
        return $x === 0
            || $x === 15
            || $y === 0
            || $y === 15
            || $x === 14 && $y === 1
            || $y === 14 && $x === 1
            || $x === 1 && $y === 1
            || $x === 14 && $y === 14;
    }

    public function placeOnMap(AbstractRobot $robot): void
    {
        $location = $robot->getLocation();

        for ($y = 0; $y < count($this->mapGrid); $y++) {
            for ($x = 0; $x < count($this->mapGrid[$y]); $x++) {
                if ($location->getY() === $y && $location->getX() === $x) {
                    $this->mapGrid[$y][$x] = $robot;

                    break;
                }
            }
        }
    }

    public function neighbors(AbstractRobot $robot): array
    {
        $location = $robot->getLocation();

        $x = $location->getX();
        $y = $location->getY();

        $neighbors = [
            'U' => ['coordinates' => ['x' => $x, 'y' => $y + 1], 'holds' => $this->mapGrid[$y + 1][$x]],
            'L' => ['coordinates' => ['x' => $x - 1, 'y' => $y], 'holds' => $this->mapGrid[$y][$x - 1]],
            'D' => ['coordinates' => ['x' => $x, 'y' => $y - 1], 'holds' => $this->mapGrid[$y - 1][$x]],
            'R' => ['coordinates' => ['x' => $x + 1, 'y' => $y], 'holds' => $this->mapGrid[$y][$x + 1]],
        ];

        $neighbors['N'] = $neighbors['U'];
        $neighbors['E'] = $neighbors['R'];
        $neighbors['S'] = $neighbors['D'];
        $neighbors['W'] = $neighbors['L'];

        return $neighbors;
    }

    public function friendlyRobots(): array
    {
        $friendlyRobots = [];

        for ($y = 0; $y < count($this->mapGrid); $y++) {
            for ($x = 0; $x < count($this->mapGrid[$y]); $x++) {
                if ($this->mapGrid[$y][$x] instanceof FriendlyRobot) $friendlyRobots[] = $this->mapGrid[$y][$x];
            }
        }

        return $friendlyRobots;
    }
}
