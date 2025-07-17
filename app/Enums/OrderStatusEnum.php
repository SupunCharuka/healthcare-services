<?php

namespace App\Enums;

enum OrderStatusEnum: int
{
    case pending = 0;
    case approved = 1;
    case rejected = 2;

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
