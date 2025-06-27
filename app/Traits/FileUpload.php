<?php

namespace App\Traits;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

trait FileUpload
{
    public function fileUpload(UploadedFile $file , string $directory = 'uploads'): string
    {
        // důvod try-catch je chyba asi v laravelu, potřeba přeskočit tuto chybu
        try {
            $filename = 'educore_'.uniqid().'.'.$file->getClientOriginalExtension();
            // move a file to the storage
            $file->move(public_path($directory), $filename);

            return '/'.$directory.'/'.$filename;
        }
        catch(Exception $e) {
            throw $e;
        }
    }


    public function deleteFile(?string $path): bool
    {
        if (File::exists(public_path($path)))
        {
            File::delete(public_path($path));
            return true;
        }
        return false;
    }
}
