<?php

namespace App\Service\FileUploader;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class SimpleUploader
{
    static function upload(UploadedFile $file)
    {
        $imageName = time().'.' . $file->getClientOriginalExtension();

        $file->move(public_path('uploads'), $imageName);

        return '/uploads/' . $imageName;
    }
}
