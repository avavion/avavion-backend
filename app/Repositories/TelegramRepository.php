<?php

namespace App\Repositories;

use App\Contracts\Repositories\TelegramRepositoryContract;
use App\Dto\Telegram\TelegramMessageDto;
use App\Dto\Telegram\TelegramEditMessageDto;
use App\Enums\Telegram\TelegramActionEnum;
use Illuminate\Support\Facades\Http;
use Throwable;

readonly class TelegramRepository implements TelegramRepositoryContract
{
    /**
     * @param TelegramMessageDto $message
     * @param int $counter
     * @return void
     */
    public function sendMessage(TelegramMessageDto $message, int $counter = 0): void
    {
        $limit = config('telegram.retries_limit');

        if ($counter > $limit) {
            return;
        }

        try {
            $response = Http::post(TelegramActionEnum::SEND_MESSAGE->getMethod(), [
                'chat_id' => $message->chatId,
                'text' => $message->text,
                'parse_mode' => $message->parseMode->value
            ]);

            /** @var boolean $isOk */
            $isOk = $response->json('ok');

            if (!$isOk) {
                if ($response->json('error_code') === 429) {
                    sleep($response->json('parameters.retry_after'));

                    $this->sendMessage($message, $counter++);
                }

                return;
            }
        } catch (Throwable) {
            $this->sendMessage($message, $counter++);

            return;
        }
    }

    /**
     * @param TelegramEditMessageDto $message
     * @param int $counter
     * @return void
     */
    public function editMessage(TelegramEditMessageDto $message, int $counter = 0): void
    {
        $limit = config('telegram.retries_limit');

        if ($counter > $limit) {
            return;
        }

        try {
            $response = Http::post(TelegramActionEnum::EDIT_MESSAGE->getMethod(), [
                'chat_id' => $message->chatId,
                'text' => $message->message,
                'parse_mode' => $message->parseMode->value,
                'message_id' => $message->messageId,
            ]);

            /** @var boolean $isOk */
            $isOk = $response->json('ok');

            if (!$isOk) {
                if ($response->json('error_code') === 429) {
                    sleep($response->json('parameters.retry_after'));

                    $this->editMessage($message, $counter++);
                }

                return;
            }
        } catch (Throwable) {
            $this->editMessage($message, $counter++);

            return;
        }
    }
}
