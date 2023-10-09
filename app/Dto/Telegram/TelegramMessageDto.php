<?php

namespace App\Dto\Telegram;

use App\Enums\Telegram\TelegramParseModeEnum;

readonly class TelegramMessageDto
{
    public function __construct(
        public int                   $chatId,
        public string                $text,
        public TelegramParseModeEnum $parseMode = TelegramParseModeEnum::MARKDOWN
    )
    {
    }
}
