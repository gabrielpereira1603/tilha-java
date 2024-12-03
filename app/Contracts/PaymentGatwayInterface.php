<?php

namespace App\Contracts;

interface PaymentGatwayInterface
{
    public function process(array $data): array;
}
