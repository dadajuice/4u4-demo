<?php

class Validation
{
    public static function phone(string $value): bool
    {
        return self::regex("[0-9]{3}-[0-9]{3}-[0-9]{4}", $value);
    }

    public static function email(string $value): bool
    {
        return self::regex("[-_.a-z0-9]+@[a-z0-9]+(\.[a-z]{2,})+", $value);
    }

    public static function zipCode(string $value): bool
    {
        return self::regex("[A-Z][0-9][A-Z][0-9][A-Z][0-9]", $value);
    }

    public static function regex(string $pattern, string $value): bool
    {
        return preg_match('/^' . $pattern . '$/i', $value);
    }
}
