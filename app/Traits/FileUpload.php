<?php

namespace App\Traits;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait FileUpload
{
    /**
     * Nahraje soubor na určený disk (defaultně 'public/uploads')
     *
     * @param UploadedFile $file
     * @param string $directory - cílový adresář (bez /storage/)
     * @param string $disk - Laravel disk (defaultně 'public')
     * @return string - veřejná URL nebo cesta
     * @throws Exception
     */
    public function fileUpload(UploadedFile $file, string $directory = 'uploads', string $disk = 'public2'): string
    {
        try {
            // Unikátní název souboru
            $filename = 'educore_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Uloží soubor do /public/uploads
            return $file->storeAs($directory, $filename, $disk);
        }
        catch (Exception $e) {
            throw new Exception('File upload failed: ' . $e->getMessage());
        }
    }

    /**
     * Smaže soubor ze storage (např. /storage/uploads/...)
     *
     * @param string|null $path - cesta nebo URL souboru
     * @param string $disk - Laravel disk
     * @return bool
     */
    public function deleteFile(?string $path, string $disk = 'public2'): bool
    {
        if (!$path) {
            return false;
        }

        if (Storage::disk($disk)->exists($path))
        {
            Storage::disk($disk)->delete($path);
            return true;
        }

        return false;
    }
}
