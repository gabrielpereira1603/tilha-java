<?php

namespace App\Enums;

enum BillingTypeEnum: string
{
    case BOLETO = 'BOLETO';
    case PIX = 'PIX';
    case UNDEFINED = 'UNDEFINED';
}
