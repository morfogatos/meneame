<?php

namespace app\models;

use dektrium\user\models\Profile as BaseProfile;
use Yii;

class Profile extends BaseProfile
{
    public function getAvatar()
    {
        $uploads = Yii::getAlias('@uploads');
        $ruta = "$uploads/{$this->user_id}.jpg";
        return file_exists($ruta) ? "/$ruta" : "/$uploads/default.png";
    }
}
