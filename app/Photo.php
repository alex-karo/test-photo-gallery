<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'title',
        'file'
    ];

    protected $visible = [
        'title',
        'file'
    ];

    /**
     * Get files from other server
     *
     * @param string $value Path to image
     * @return string
     */

    public function getFileAttribute($value) {
        return env('APP_STATIC_URL') . $value;
    }

    /**
     * Save file to server
     *
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file File
     */

    public function setFileAttribute($file) {
        $imagesFolder = '/img/catalog';
        $imagePath = public_path() . $imagesFolder;
        $extension = $file->getClientOriginalExtension();
        $newFileName = uniqid() . '.' . $extension;
        // TODO: Проверка на то, уникально ли наше имя
        $file->move($imagePath, $newFileName);
        $this->attributes['file'] = "$imagesFolder/$newFileName";
    }
}
