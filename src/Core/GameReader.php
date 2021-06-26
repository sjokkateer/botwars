<?php

namespace App\Core;

use App\Core\Exceptions\InputStringFormatException;
use App\Core\Exceptions\StdInReadingException;

class GameReader
{
    public function read(string $file): array
    {
        $stdInString = file_get_contents($file);
        $lines = explode("\n", $stdInString);
        $gameLine = array_shift($lines);
        
        if ($gameLine === null) {
            throw new StdInReadingException($stdInString);
        }
        
        $pieces = explode('#', $gameLine);

        if (count($pieces) < 2) {
            throw new InputStringFormatException($gameLine);
        }

        return [
            'game_data' => $pieces[0],
            'map_state' => $pieces[1],
            'user_data' => $pieces[2] ?? '',
        ];
    }
}
