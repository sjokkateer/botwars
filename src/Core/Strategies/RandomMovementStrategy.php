<?php

namespace App\Core\Strategies;

use App\Core\AbstractRobot;
use App\Core\Coordinate;
use App\Core\Map;
use Closure;

class RandomMovementStrategy implements RobotStrategyInterface
{
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
            $available = array_filter($available, Closure::fromCallable([$this, 'isNotSpawnTile']));
        }

        if (empty($available)) {
            return "{$robot->getLocation()}-D";
        }

        $choice = array_rand($available);
        $coordinates = array_values($available[$choice]['coordinates']);
        self::$madeMoves[] = $coordinates;

        return "{$robot->getLocation()}-M-$choice";
    }

    private function isNotSpawnTile(array $tile): bool
    {
        return $this->isSpawnTile($tile) === false;
    }

    private function isSpawnTile(array $tile): bool
    {
        return in_array(array_values($tile['coordinates']), Coordinate::SPAWN_TILES);
    }
}
