<?php

namespace App\Core;

class Client
{
    public static function main()
    {
        $gameReader = new GameReader;
        $info = $gameReader->read('php://stdin');

        $gameData = new GameData(...explode(',', $info['game_data']));

        $map = new Map;
        $mapData = explode(',', $info['map_state']);

        foreach ($mapData as $data) {
            $creationData = explode('-', $data);
            [$type, $coordinates, $health] = [$creationData[0], explode(':', $creationData[1]), $creationData[2]];

            $robot = AbstractRobot::create($type, new Coordinate(...$coordinates), $health);
            $map->placeOnMap($robot);
        }

        $userData = $info['user_data'];

        echo (new Game($gameData, $map, $userData))->play();
    }
}

Client::main();
