<?php

namespace App\Core;

class Game
{
    public function __construct(
        private GameData $gameData,
        private Map $map,
        private string $userData,
    ) {
    }

    public function play(): void
    {
        // Hier waarschijnlijk een foreach robot -> execute()
        // Dan uiteindelijk deze string returnen naar het systeem
        // zodat er iets gebeurd. (de collectieve move)

        // Dus voor robots zouden we een spl obj storage kunnen hanteren
        // van robots, deze zijn bewust van hun locatie op de map?
        // waar de map enkel inzicht geeft in de tiles? en wat er op een tile staat
        // en dus een API biedt voor bijvoorbeeld afstanden bepalen etc. voor een robot.
    }
}
