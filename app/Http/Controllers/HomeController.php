<?php

namespace App\Http\Controllers;


use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function linter()
    {
        $jsonFile = Storage::disk('public')->get('phpcs/phpcs.json');
        $file = Storage::disk('public')->get('phpcs/phpcs.xml');
        $xml = new \SimpleXMLElement($file);
        //dd($xml);
        return view('admin.linter', [
            "json" => json_decode($jsonFile),
            "xml" => $xml
        ]);
    }
}
