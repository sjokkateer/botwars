<?php

namespace App\Core\Strategies;

use App\Core\AbstractRobot;

interface RobotStrategyInterface
{
    public function execute(AbstractRobot $robot): string;
}
