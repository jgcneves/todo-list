<?php

namespace App\Enums;

enum TaskStatus: int
{
    case Pending = 0;
    case Completed = 1;

    public static function isValid(bool $value): bool
    {
        return in_array($value, array_column(self::cases(), 'value'), true);
    }
}
