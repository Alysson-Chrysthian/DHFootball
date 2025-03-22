<?php

namespace App\Enums;

enum Age: int
{
    case FIFTEEN_TO_TWENTY = 1;
    case TWENTY_TO_THIRTY = 2;
    case THIRTY_TO_THIRTY_FIVE = 3;
    case THIRTY_FIVE_PLUS = 4;

    public function text()
    {
        return match ($this) {
            Age::FIFTEEN_TO_TWENTY => '15 - 20',
            Age::TWENTY_TO_THIRTY => '20 - 30',
            Age::THIRTY_TO_THIRTY_FIVE => '30 - 35',
            Age::THIRTY_FIVE_PLUS => '35+',
        };
    }

    public function range()
    {
        return match ($this) {
            Age::FIFTEEN_TO_TWENTY => [15, 20],
            Age::TWENTY_TO_THIRTY => [20, 30],
            Age::THIRTY_TO_THIRTY_FIVE => [30, 35],
            Age::THIRTY_FIVE_PLUS => [35, 100],
        };
    }
}
