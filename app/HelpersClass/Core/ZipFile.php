<?php


namespace App\HelpersClass\Core;


use Exception;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use ZanySoft\Zip\Zip;

class ZipFile
{
    public static function fileFbx($zipFile, $id)
    {
        try {
            self::downloadTempFile($zipFile);
            $zip = Zip::open(public_path('storage/tempory/tempory.zip'));
            $zip->extract(public_path('storage/tempory/'));

            $files = Storage::disk('public')->allFiles('tempory/');

            foreach ($files as $file) {
                $ars[] = [basename(public_path('storage/' . $file))];
                $name = basename(public_path('storage/' . $file));
                Storage::disk('sftp')->put('download/' . $id . '/fbx/' . $name, file_get_contents(public_path('storage/' . $file)));
            }

            $zip->close();
            self::deleteTempFile();
            Storage::disk('sftp')->delete('download/' . $id . '/fbx/tempory.zip');
            return null;
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Télécharge un fichier dans un dossier temporaire et le définie en public
     * @param $content
     * @return string|null
     */
    private static function downloadTempFile($content)
    {
        try {
            Storage::disk('public')->put('tempory/tempory.zip', $content);
            Storage::disk('public')->setVisibility('tempory/tempory.zip', 'public');
            return null;
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    private static function deleteTempFile()
    {
        Storage::disk('public')->deleteDirectory('tempory/');
    }
}
