<?php

namespace App\Core;

class SpawnTileMinHeap extends \SplMinHeap
{
    /**
     * @param AbstractRobot $robot
     * @param AbstractRobot $otherRobot
     * @return integer
     */
    protected function compare($robot, $otherRobot): int
    {
        $robotDistances = [];
        $otherRobotDistances = [];

        [$robotX, $robotY] = [$robot->getLocation()->getX(), $robot->getLocation()->getY()];
        [$otherRobotX, $otherRobotY] = [$otherRobot->getLocation()->getX(), $otherRobot->getLocation()->getY()];

        foreach (Coordinate::SPAWN_TILES as $spawnTile) {
            [$spawnTileX, $spawnTileY] = $spawnTile;
            $robotDistances[] = sqrt(pow(($spawnTileX - $robotX), 2) + pow(($spawnTileY - $robotY), 2));
            $otherRobotDistances[] = sqrt(pow(($spawnTileX - $otherRobotX), 2) + pow(($spawnTileY - $otherRobotY), 2));
        }

        $robotMinDistance = min($robotDistances);
        $otherRobotMinDistance = min($otherRobotDistances);

        return $robotMinDistance <=> $otherRobotMinDistance;
    }
}
