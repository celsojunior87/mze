<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait ImageHandler
{

    public function createUrlImagem($urlImagem, $nomeImg, $folder = "")
    {
        if ($this->checkFileExists($urlImagem)) {
            return $urlImagem;
        }

        $image_parts = explode(";base64,", $urlImagem);
        $image_type_aux = explode("image/", $image_parts[0]);

        if (array_key_exists('1', $image_type_aux) == false) {
            return false;
        }

        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);

        $fileName =  $folder . DIRECTORY_SEPARATOR . $nomeImg . '.' . $image_type;
        $save = Storage::disk('public')->put($fileName, $image_base64);

        if ($save) {
            return $fileName;
        }

        return null;
    }

    public function checkFileExists($path)
    {
        return Storage::disk('public')->exists($path);
    }
}
