<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;

trait FileUpload
{
    public function fileUpload(UploadedFile $file , string $directory = 'uploads'): string
    {
        $filename = 'educore_'.uniqid().'.'.$file->getClientOriginalExtension();

        // move a file to the storage
        $file->move(public_path($directory), $filename);

        return '/'.$directory.'/'.$filename;
    }
}
