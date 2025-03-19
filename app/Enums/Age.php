<?php

namespace App\Enums;

enum Age: int
{
    case FIFTEEN_TO_TWENTY = 0;
    case TWENTY_TO_THIRTY = 1;
    case THIRTY_TO_THIRTY_FIVE = 2;
    case THIRTY_FIVE_PLUS = 3;

    public function text()
    {
        return match ($this) {
            Age::FIFTEEN_TO_TWENTY => '15 - 20',
            Age::TWENTY_TO_THIRTY => '20 - 30',
            Age::THIRTY_TO_THIRTY_FIVE => '30 - 35',
            Age::THIRTY_FIVE_PLUS => '35+',
        };
    }
}
