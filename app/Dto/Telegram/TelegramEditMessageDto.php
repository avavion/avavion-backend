<?php

namespace App\Dto\Telegram;

use App\Enums\Telegram\TelegramParseModeEnum;

readonly class TelegramEditMessageDto
{
    public function __construct(
        public string $message,
        public int $chatId,
        public int $messageId,
        public TelegramParseModeEnum $parseMode = TelegramParseModeEnum::MARKDOWN
    ) {
    }
}
