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
     * @return array<string>
     */
    public static function getAllSystemValues(): array
    {
        return [
            self::GITHUB->value
        ];
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
