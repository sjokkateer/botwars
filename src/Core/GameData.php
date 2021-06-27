<?php

namespace App\Core;

class GameData
{
    private $currentTurn;
    private $lastTurn;
    private $ourPlayerId;

    public function __construct(
        int $currentTurn,
        int $lastTurn,
        int $ourPlayerId
    ) {
        $this->currentTurn = $currentTurn;
        $this->lastTurn = $lastTurn;
        $this->ourPlayerId = $ourPlayerId;
    }

    public function getCurrentTurn(): int
    {
        return $this->currentTurn;
    }

    public function getLastTurn(): int
    {
        return $this->lastTurn;
    }

    public function getOurPlayerId(): int
    {
        return $this->ourPlayerId;
    }
}
