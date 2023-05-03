<?php

use Illuminate\Support\Facades\File;

function deleteFileStorage($image)
{
    $imageThumb = dirname($image).'/thumbs/'.basename($image);
    File::delete(public_path($image));
    File::delete(public_path($imageThumb));
}