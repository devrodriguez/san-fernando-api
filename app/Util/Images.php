<?php

namespace App\Util;

use Illuminate\Support\Facades\Storage;

class Images {
    public static function store_image($name, $folder, $encodeContent) {
        $dataImage = '';
        $codeImage = '';
        $compImage = explode(",", $encodeContent);

        if(count($compImage) > 1) {
            $dataImage = $compImage[0];
            $codeImage = $compImage[1];
        }

        Storage::put($folder."/".$name, base64_decode($codeImage));
    }
}