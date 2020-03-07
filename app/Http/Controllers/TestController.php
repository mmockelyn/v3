<?php

namespace App\Http\Controllers;


use App\HelpersClass\Core\ZipFile;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Storage;
use Webpatser\Uuid\Uuid;

class TestController extends Controller
{
    public function test()
    {
        dd(ZipFile::get(Storage::disk('sftp')->get('download/1/f9b2fcf0-5fb5-11ea-a8e4-211fc8a07420.zip'), 1));
    }
}
