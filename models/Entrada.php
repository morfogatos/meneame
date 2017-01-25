<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "entradas".
 *
 * @property integer $id
 * @property string $url
 * @property string $titulo
 * @property string $texto
 * @property string $created_at
 * @property integer $categoria_id
 *
 * @property EntradasEtiquetas[] $entradasEtiquetas
 */
class Entrada extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entradas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url', 'titulo', 'texto', 'categoria_id'], 'required'],
            [['created_at'], 'safe'],
            [['categoria_id'], 'integer'],
            [['url'], 'string', 'max' => 255],
            [['titulo'], 'string', 'max' => 120],
            [['texto'], 'string', 'max' => 550],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'titulo' => 'Titulo',
            'texto' => 'Texto',
            'created_at' => 'Created At',
            'categoria_id' => 'Categoria ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntradasEtiquetas()
    {
        return $this->hasMany(EntradasEtiquetas::className(), ['entrada_id' => 'id'])->inverseOf('entrada');
    }
}
