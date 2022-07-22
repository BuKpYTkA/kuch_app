<?php

namespace App\Utils\Enum;

enum OrderStatus: int
{
    case NEW = 1;
    case PAID = 2;
    case SHIPPED = 3;
    case COMPLETED = 4;
    case CANCELED = 5;
}
