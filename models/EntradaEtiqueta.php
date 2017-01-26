<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "entradas_etiquetas".
 *
 * @property integer $entrada_id
 * @property integer $etiqueta_id
 *
 * @property Entradas $entrada
 * @property Etiquetas $etiqueta
 */
class EntradaEtiqueta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entradas_etiquetas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entrada_id', 'etiqueta_id'], 'required'],
            [['entrada_id', 'etiqueta_id'], 'integer'],
            [['entrada_id'], 'exist', 'skipOnError' => true, 'targetClass' => Entrada::className(), 'targetAttribute' => ['entrada_id' => 'id']],
            [['etiqueta_id'], 'exist', 'skipOnError' => true, 'targetClass' => Etiqueta::className(), 'targetAttribute' => ['etiqueta_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'entrada_id' => 'Entrada ID',
            'etiqueta_id' => 'Etiqueta ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntrada()
    {
        return $this->hasOne(Entrada::className(), ['id' => 'entrada_id'])->inverseOf('entradaEtiquetas');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEtiqueta()
    {
        return $this->hasOne(Etiqueta::className(), ['id' => 'etiqueta_id'])->inverseOf('entradaEtiquetas');
    }
}
