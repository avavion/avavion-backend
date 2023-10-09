<?php

namespace App\Contracts\Repositories;

use App\Dto\Telegram\TelegramMessageDto;
use App\Dto\Telegram\TelegramEditMessageDto;

interface TelegramRepositoryContract
{
    public function sendMessage(TelegramMessageDto $message, int $counter = 0): void;

    public function editMessage(TelegramEditMessageDto $message, int $counter = 0): void;
}
