<?php

namespace App\Enums;

enum Status: int
{
    
    case IN_ANALISYS = 1;
    case SELECTED = 2;
    case DELETE = 3;

    public function text()
    {
        return match ($this) {
            Status::IN_ANALISYS => 'Em analise',
            Status::SELECTED => 'Selecionado',
            Status::DELETE => 'Deletado'
        };
    }

}
