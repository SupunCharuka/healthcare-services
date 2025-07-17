<?php

namespace App\Enums;

enum PayHerePaymentStatusEnum: int
{
    case success = 2;

    case  pending = 0;

    case  canceled = -1;

    case  failed = -2;

    case  chargedBack = -3;

    public static function getKeyByValue(int $value): string|null
    {
        foreach (self::cases() as $key => $val) {
            if ($val->value === $value) {
                return $val->name;
            }
        }

        return null; // Return null if the value is not found.
    }
}
