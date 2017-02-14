<?php

namespace app\models;

/**
 * This is the model class for table "meneos".
 *
 * @property integer $usuario_id
 * @property integer $entrada_id
 *
 * @property Entradas $entrada
 * @property User $usuario
 */
class Meneo extends \yii\db\ActiveRecord
{
    /**
     * Nombre de tabla de Meneo
     */
    public static function tableName()
    {
        return 'meneos';
    }

    /**
     * Reglas de Meneo
     */
    public function rules()
    {
        return [
            [['usuario_id', 'entrada_id'], 'required'],
            [['usuario_id', 'entrada_id'], 'integer'],
            [['entrada_id'], 'exist', 'skipOnError' => true, 'targetClass' => Entrada::className(), 'targetAttribute' => ['entrada_id' => 'id']],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * Labels de los atributos de Meneo
     */
    public function attributeLabels()
    {
        return [
            'usuario_id' => 'Usuario ID',
            'entrada_id' => 'Entrada ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntrada()
    {
        return $this->hasOne(Entrada::className(), ['id' => 'entrada_id'])->inverseOf('meneos');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'usuario_id'])->inverseOf('meneos');
    }
}
