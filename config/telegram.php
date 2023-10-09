<?php

return [
    'token' => env('TELEGRAM_BOT_TOKEN'),
    'retries_limit' => env('TELEGRAM_RETRIES_LIMIT', 10)
];
