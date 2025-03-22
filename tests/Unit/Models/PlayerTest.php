<?php

namespace Tests\Unit\Models;

use App\Models\Player;
use Illuminate\Support\Facades\Date;
use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase
{

    public function test_get_age()
    {
        $player = new Player();
        $player->birthday = Date::now()->subYears(15);

        $age = $player->getAge();

        $this->assertEquals(15, $age);
    }

}
