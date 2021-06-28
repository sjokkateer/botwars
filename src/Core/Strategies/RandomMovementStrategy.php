<?php

namespace App\Core\Strategies;

use App\Core\AbstractRobot;
use App\Core\Map;

class RandomMovementStrategy implements RobotStrategyInterface
{
    private const SPAWN_TILES = [
        [4, 4],
        [11, 11],
        [4, 11],
        [11, 4],
    ];

    private static $madeMoves = [];

    private $currentTurn;
    private $map;

    public function __construct(
        int $currentTurn,
        Map $map
    ) {
        $this->currentTurn = $currentTurn;
        $this->map = $map;
    }

    public function execute(AbstractRobot $robot): string
    {
        $neighbors = $this->map->neighbors($robot);
        $available = array_filter($neighbors, fn ($neighbor) => empty($neighbor['holds']));
        $available = array_filter($available, fn ($av) => !in_array(array_values($av['coordinates']), self::$madeMoves));

        if ($this->currentTurn % 10 === 0) {
            $available = array_filter($available, fn ($av) => !$this->isSpawnTile($av));
        }

        if (empty($available)) {
            return "{$robot->getLocation()}-D";
        }

        $choice = array_rand($available);
        $coordinates = array_values($available[$choice]['coordinates']);
        self::$madeMoves[] = $coordinates;

        return "{$robot->getLocation()}-M-$choice";
    }

    private function isSpawnTile(array $tile): bool
    {
        $coordinates = $tile['coordinates'];
        $t = [$coordinates['x'], $coordinates['y']];

        $isSpanwTile = in_array($t, self::SPAWN_TILES);

        return $isSpanwTile;
    }
}
