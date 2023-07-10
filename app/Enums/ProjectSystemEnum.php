<?php

namespace App\Enums;

enum ProjectSystemEnum: string
{
    case MANUAL = 'manual';
    case GITLAB = 'gitlab';
    case BITBUCKET = 'bitbucket';
    case GITHUB = 'github';

    /**
     * @return array<self>
     */
    public static function getAllSystems(): array
    {
        return [self::GITHUB, self::GITLAB, self::BITBUCKET, self::MANUAL];
    }

    /**
     * @return string
     */
    public function getSystemLabel(): string
    {
        return match ($this) {
            self::GITHUB => 'GitHub',
            self::GITLAB => 'GitLab',
            self::BITBUCKET => 'Bitbucket',
            self::MANUAL => 'avavion.ru'
        };
    }
}
