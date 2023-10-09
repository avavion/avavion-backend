<?php

namespace App\Support;

use App\Dto\Support\UploadFileDto;
use Illuminate\Support\Facades\Storage;

class StorageUploadSupport
{

    /**
     * @param UploadFileDto $dto
     * @return string|false
     */
    public static function upload(UploadFileDto $dto): string|false
    {
        if (is_null($dto->file))
            return $dto->oldUrl;

        if (!is_null($dto->oldUrl)) {
            if (Storage::exists($dto->oldUrl)) {
                Storage::delete($dto->oldUrl);
                return $dto->file->store($dto->dir);
            }
        }

        return $dto->file->store($dto->dir);
    }
}
