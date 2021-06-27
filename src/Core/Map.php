<?php

namespace App\Core;

class Map
{
    private const WIDTH = 16;
    private const HEIGHT = 16;

    private const ROBOT_TYPE = [
        'F' => FriendlyRobot::class,
        'E' => HostileRobot::class,
    ];

    private array $mapGrid;

    public function __construct(array $robotData)
    {
        $this->mapGrid = $this->makeGrid();

        foreach ($robotData as $robot) {
            $data = explode('-', $robot);

            [$type, $coordinates, $health] = [$data[0], explode(':', $data[1]), $data[2]];

            $class = self::ROBOT_TYPE[$type];
            $robot = new $class(new Coordinate(...$coordinates), $health);

            $this->placeOnMap($robot);
        }
    }

    // Grid is an array of arrays.
    // a tile is empty meaning there is
    // no robot on it. Otherwise
    // it will contain a robot on it.
    private function makeGrid(): array
    {
        $grid = [];

        for ($i = 0; $i < self::HEIGHT; $i++) {
            $grid[] = [];

            for ($j = 0; $j < self::WIDTH; $j++) {
                $grid[$i][] = [];
            }
        }

        return $grid;
    }

    private function placeOnMap(AbstractRobot $robot): void
    {
        // x, y both start at 1
        $location = $robot->getLocation();

        for ($y = 0; $y < count($this->mapGrid); $y++) {
            for ($x = 0; $x < count($this->mapGrid[$y]); $x++) {
                if ($location->getY() - 1 === $y && $location->getX() - 1 === $x) {
                    $this->mapGrid[$y][$x] = $robot;

                    break;
                }
            }
        }
    }
}
