<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'stock',
        'category'
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    /**
     * Get the full URL for the product image
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return $this->getDefaultImageUrl();
        }

        // If it's already a full URL (for backward compatibility)
        if (filter_var($this->image, FILTER_VALIDATE_URL)) {
            return $this->image;
        }

        // If the path starts with 'storage/', use asset() directly
        if (str_starts_with($this->image, 'storage/')) {
            return asset($this->image);
        }

        // If it's a storage path without 'storage/' prefix
        return Storage::disk('public')->url($this->image);
    }

    /**
     * Get default image URL
     */
    public function getDefaultImageUrl()
    {
        return \App\Helpers\ImageHelper::getDefaultProductImage();
    }

    /**
     * Check if product has an image
     */
    public function hasImage()
    {
        return !empty($this->image);
    }

    /**
     * Get thumbnail URL (for admin lists)
     */
    public function getThumbnailUrlAttribute()
    {
        return $this->getImageUrlAttribute();
    }
}
