<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    /**
     * Subir y procesar una imagen de producto
     *
     * @param UploadedFile $file
     * @param string|null $oldImagePath
     * @return string
     */
    public static function uploadProductImage(UploadedFile $file, ?string $oldImagePath = null): string
    {
        // Eliminar imagen anterior si existe (extraer solo la parte del storage)
        if ($oldImagePath) {
            $storagePath = str_replace('storage/', '', $oldImagePath);
            if (Storage::disk('public')->exists($storagePath)) {
                Storage::disk('public')->delete($storagePath);
            }
        }

        // Generar nombre único para el archivo
        $filename = uniqid('product_') . '.' . $file->getClientOriginalExtension();
        $storagePath = 'products/' . $filename;

        // Guardar archivo
        $file->storeAs('products', $filename, 'public');

        // Validar que el archivo se guardó correctamente
        if (!Storage::disk('public')->exists($storagePath)) {
            throw new \Exception('Error al guardar la imagen.');
        }

        // Retornar la ruta completa para la web
        return 'storage/' . $storagePath;
    }

    /**
     * Eliminar imagen de producto
     *
     * @param string $imagePath
     * @return bool
     */
    public static function deleteProductImage(string $imagePath): bool
    {
        // Si la ruta empieza con 'storage/', quitarla para usar con el disk
        $storagePath = str_replace('storage/', '', $imagePath);
        
        if (Storage::disk('public')->exists($storagePath)) {
            return Storage::disk('public')->delete($storagePath);
        }

        return true;
    }

    /**
     * Obtener URL de imagen por defecto para productos
     *
     * @return string
     */
    public static function getDefaultProductImage(): string
    {
        return asset('images/no-image.svg');
    }

    /**
     * Validar si un archivo es una imagen válida
     *
     * @param UploadedFile $file
     * @return bool
     */
    public static function isValidImage(UploadedFile $file): bool
    {
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
        $maxSize = 2 * 1024 * 1024; // 2MB

        return in_array($file->getMimeType(), $allowedTypes) && $file->getSize() <= $maxSize;
    }

    /**
     * Obtener información de una imagen
     *
     * @param string $imagePath
     * @return array
     */
    public static function getImageInfo(string $imagePath): array
    {
        $fullPath = storage_path('app/public/' . $imagePath);

        if (!file_exists($fullPath)) {
            return [
                'exists' => false,
                'size' => 0,
                'dimensions' => null,
                'mime_type' => null
            ];
        }

        $imageInfo = getimagesize($fullPath);
        $fileSize = filesize($fullPath);

        return [
            'exists' => true,
            'size' => $fileSize,
            'size_formatted' => self::formatBytes($fileSize),
            'dimensions' => $imageInfo ? $imageInfo[0] . 'x' . $imageInfo[1] : null,
            'mime_type' => $imageInfo ? $imageInfo['mime'] : null,
            'width' => $imageInfo ? $imageInfo[0] : null,
            'height' => $imageInfo ? $imageInfo[1] : null
        ];
    }

    /**
     * Formatear bytes en unidades legibles
     *
     * @param int $bytes
     * @return string
     */
    private static function formatBytes(int $bytes): string
    {
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } else {
            return $bytes . ' bytes';
        }
    }
}
