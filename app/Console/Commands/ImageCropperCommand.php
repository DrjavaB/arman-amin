<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Intervention\Image\Facades\Image;
use Storage;

class ImageCropperCommand extends Command
{
    protected $signature = 'image:crop';

    protected $description = 'Command description';

    public function handle(): void
    {
        $raw_images = Storage::disk('public')->files('raw_images');
        if (count($raw_images) > 10)
            $raw_images = array_slice($raw_images, 0, 10);
        foreach ($raw_images as $path) {
            $image = Image::make(public_path('storage/' . $path)); // require php-gd module
            $is_vertical = $image->width() < $image->height();
            $image->resize($is_vertical ? 100 : null, $is_vertical ? null : 100, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $image->crop(100, 100, 0, 0);
            $image->save(public_path('storage/formatted_images/' . $image->basename));
            Storage::disk('public')->delete($path);
        }
     $this->info(count($raw_images).' image(s) cropped.');
    }
}
