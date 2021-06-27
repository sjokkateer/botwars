<?php

namespace App\Core;

use App\Core\Strategies\RandomMovementStrategy;

class Game
{
    private $gameData;
    private $map;
    private $userData;

    public function __construct(
        GameData $gameData,
        Map $map,
        string $userData
    ) {
        $this->gameData = $gameData;
        $this->map = $map;
        $this->userData = $userData;
    }

    public function play(): string
    {
        $myRobots = $this->map->friendlyRobots();
        $strategy = new RandomMovementStrategy(
            $this->gameData->getCurrentTurn(),
            $this->map
        );

        $stdOut = [];

        foreach ($myRobots as $robot) {
            $stdOut[] = $strategy->execute($robot);
        }

        return implode(',', $stdOut);
    }
}
