<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;
use Yii;
use yii\imagine\Image;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'jpg'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            // $this->imageFile->saveAs('uploads/' . \Yii::$app->user->id . '.' . $this->imageFile->extension);
            $nombre = Yii::getAlias('@uploads/')
                . \Yii::$app->user->id . '.' . $this->imageFile->extension;
            $this->imageFile->saveAs($nombre);
            Image::thumbnail($nombre, 400, null)
                ->save($nombre, ['quality' => 50]);
            return true;
        } else {
            return false;
        }
    }
}
