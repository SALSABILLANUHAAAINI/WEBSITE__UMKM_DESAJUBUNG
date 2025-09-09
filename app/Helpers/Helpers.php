<?php

if (! function_exists('image_url')) {
    function image_url(?string $filename, string $type = 'product_images')
    {
        if ($filename) {
            return asset("storage/{$type}/{$filename}");
        }

        switch ($type) {
            case 'umkm_images':
                return asset('images/no-umkm.png');
            case 'katalog_images':
                return asset('images/no-katalog.png');
            default:
                return asset('images/no-image.png');
        }
    }
}
