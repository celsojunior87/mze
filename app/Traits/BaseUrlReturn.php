<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait BaseUrlReturn
{
    public function getUrl($path)
    {
        return $this->consultBaseUrl() . $path;
    }
    public function consultBaseUrl()
    {
        // $baseUrl = DB::table('tb_parametros_presidencias')->where('nome', 'base_url_storage')->get();
        $baseUrl = 'https://diaadiaarquivos.blob.core.windows.net/';

        return $baseUrl;
    }
}
