<?php

namespace App\Enums\Telegram;

enum TelegramActionEnum: string
{
    case SEND_MESSAGE = '/sendMessage';

    case EDIT_MESSAGE = '/editMessageText';

    public function getMethod(): string
    {
        return 'https://api.telegram.org/bot' . config('telegram.token') . $this->value;
    }
}
