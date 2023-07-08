<?php

namespace App\Enums;

enum UserRolesEnum: int
{
    case USER = 1;
    case ADMIN = 2;
    case BANNED = 3;

    /**
     * @return array<int>
     */
    public static function getRoleArrayValues(): array
    {
        return [self::USER->value, self::ADMIN->value, self::BANNED->value];
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return match ($this) {
            self::USER => 'user',
            self::ADMIN => 'admin',
            self::BANNED => 'banned'
        };
    }

    /**
     * @return string
     */
    public function getLabelRole(): string
    {
        return match ($this) {
            self::BANNED => 'Заблокированный',
            self::ADMIN => 'Администратор',
            default => 'Пользователь'
        };
    }
}
