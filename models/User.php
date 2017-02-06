<?php

namespace app\models;

use dektrium\user\models\User as BaseUser;
use phpDocumentor\Reflection\Types\String_;

class User extends BaseUser
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntradas()
    {
        return $this->hasMany(Entrada::className(), ['usuario_id' => 'id'])->inverseOf('usuario');
    }

    /**
     * Devuelve el avatar del usuario
     * @return String_ Ruta hacia el avatar del usuario
     */
    public function getAvatar()
    {
        return $this->profile->getAvatarMini();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeneos()
    {
        return $this->hasMany(Meneo::className(), ['usuario_id' => 'id'])->inverseOf('usuario');
    }
}
