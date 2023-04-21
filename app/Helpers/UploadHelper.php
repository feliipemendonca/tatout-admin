<?php
namespace App\Helpers;

use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class UploadHelper
{
    private $file;
    private $fileName;

    public function __construct($file)
    {
        // dd($file);
        $this->file = $file;
        $this->fileName = Str::random(20) . time() . '.' . $this->file->extension();
    }

    public function uploadImage()
    {
        Image::make($this->file->getRealPath())->save($this->getFilePath());
    }

    private function getFilePath()
    {
        return public_path('storage/' . $this->getFileName());
    }

    public function getFileType()
    {
        return explode('/', $this->file->getMimeType())[0];
    }

    public function getFileName()
    {
        return $this->fileName;
    }
}
