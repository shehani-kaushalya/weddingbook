<?php

namespace App\Services;

class FileService
{

    public static function save($file, $path)
    {
        if (!isset($file)) {
            return null;
        }
        return self::saveWithResizeName(md5(microtime(false)), $file, $path);
    }

    public static function saveWithResizeName($name, $file, $path)
    {
        if (!isset($file)) {
            return null;
        }
        $fileName = $name . "." . $file->getClientOriginalExtension();
        // print($fileName . " : " . $path . " : " . $name);
        // exit;
        $result = self::saveMemberImages($file, $path);

        if ($result == 'false') {

            return false;
        } else {
            return $result;

        }

    }

    public static function deleteFile($path)
    {

        $result = unlink($path);

        if ($result) {
            return true;
        } else {
            return false;
        }

    }

    public static function fileExist($filename, $location)
    {

        $photo_location = $location . "/" . $filename;

        if (file_exists($photo_location)) {
            // print("Image does exist : " . $photo_location);
            // exit;

            $result = self::deleteFile($photo_location);
            // print($result);
            // exit;
            return true;

        } else {
            // print("Image does not exist");
            // exit;
            return false;

        }
    }

    public static function saveMemberImages($file, $image_location)
    {

        // print_r($file . " : " . $image_location);
        // exit;

        $uniqueFileName = $image_location . "_" . uniqid() . '.' . $file->getClientOriginalExtension();
        $uniqueFileName = strtolower($uniqueFileName);

        $upload_success = $file->move(public_path($image_location), $uniqueFileName);

        if ($upload_success) {
            return $uniqueFileName;
        } else {
            return false;

        }
    }

}
