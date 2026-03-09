<?php

namespace App\Models\Reports\Traits;

use Spatie\MediaLibrary\InteractsWithMedia;

trait HasMediaFiles
{
    use InteractsWithMedia;

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('evidence_images')
            ->useDisk('public')
            ->acceptsMimeTypes([
                'image/jpeg',
                'image/png',
                'video/mp4',
            ])
            ->withResponsiveImages();
        $this->addMediaCollection('evidence_videos')
        ->useDisk('public')
        ->acceptsMimeTypes([
            'video/mp4',
            'video/avi',
            'video/mov',
        ]);
    }

    
}