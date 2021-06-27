<?php

namespace App\Core;

class GameData
{
    public function __construct(
        private int $currentTurn,
        private int $lastTurn,
        private int $ourPlayerId,
    ) {
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
