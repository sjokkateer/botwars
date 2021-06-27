<?php

namespace App\Core;

class Client
{
    public static function main()
    {
        $gameReader = new GameReader;
        $info = $gameReader->read(STDIN);

        $gameData = new GameData(...explode(',', $info['game_data']));
        $map = new Map(explode(',', $info['map_state']));
        $userData = $info['user_data'];

        echo (new Game($gameData, $map, $userData))->play();
    }
}
