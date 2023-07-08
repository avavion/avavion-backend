<?php

namespace App\Enums;

enum ProjectSystemEnum: string
{
    case GITHUB = 'github';

    /**
     * @return array<self>
     */
    public static function getAllSystems(): array
    {
        return [self::GITHUB];
    }

    /**
     * @return string
     */
    public function getSystemLabel(): string
    {
        return match ($this) {
            self::GITHUB => 'GitHub'
        };
    }
}
