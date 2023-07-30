<?php

namespace App\Dto\Support;

use Illuminate\Http\UploadedFile;

readonly class UploadFileDto
{

    public function __construct(
        public array|UploadedFile $file,
        public string             $dir,
        public ?string            $oldUrl = null
    )
    {
    }
}
