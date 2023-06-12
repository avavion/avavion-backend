<?php

namespace App\Enums;

enum UserRolesEnum: string
{
    case USER = 'user';
    case ADMIN = 'admin';
    case BANNED = 'banned';

    public function getLabelRole(): string
    {
        return match ($this) {
            self::BANNED => 'Заблокированный',
            self::ADMIN => 'Администратор',
            default => 'Пользователь'
        };
    }
}
