<?php

namespace App\Enums;

enum UserRolesEnum: string
{
    case USER = 'user';
    case ADMIN = 'admin';
    case BANNED = 'banned';

    /**
     * @return array<string>
     */
    public static function getRoleArrayValues(): array
    {
        return [self::USER->value, self::ADMIN->value, self::BANNED->value];
    }

    public function getLabelRole(): string
    {
        return match ($this) {
            self::BANNED => 'Заблокированный',
            self::ADMIN => 'Администратор',
            default => 'Пользователь'
        };
    }
}
