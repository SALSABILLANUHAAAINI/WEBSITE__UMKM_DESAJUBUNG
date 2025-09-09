<?php

if (! function_exists('produk_image')) {
    function produk_image(?string $filename)
    {
        if ($filename) {
            return asset('storage/product_images/' . $filename);
        }
        return asset('images/no-image.png');
    }
}
