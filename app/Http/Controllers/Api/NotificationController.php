<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\Services\NotificationServiceContract;
use App\Dto\Telegram\TelegramWebhookDto;

class NotificationController extends Controller
{
    public function __construct(
        readonly private NotificationServiceContract $notificationService,
    ) {
    }

    public function telegramWebhook(Request $request)
    {
        $response = $this->notificationService->telegramWebhook(new TelegramWebhookDto(

        ));

        return $this->sendResponse([
            'status' => $response
        ]);
    }
}
