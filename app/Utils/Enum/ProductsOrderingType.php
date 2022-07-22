<?php

namespace App\Utils\Enum;

enum ProductsOrderingType: string
{
    case TITLE = 'title';
    case PRICE = 'price';
    case CREATED_AT = 'created_at';
}
