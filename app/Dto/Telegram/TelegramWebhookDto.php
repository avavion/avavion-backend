<?php

namespace App\Dto\Telegram;

readonly class TelegramWebhookDto
{
    public function __construct(
        public string $chatId,
        public string $message,
        public string $messageId,
    ) {
    }
}
