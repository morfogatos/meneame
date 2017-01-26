<?php

namespace app\models;

use Yii;
use dektrium\user\models\User;

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
 * @property Categorias $categoria
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
            [['categoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['categoria_id' => 'id']],
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
    public function getCategoria()
    {
        return $this->hasOne(Categoria::className(), ['id' => 'categoria_id'])->inverseOf('entradas');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntradaEtiquetas()
    {
        return $this->hasMany(EntradaEtiqueta::className(), ['entrada_id' => 'id'])->inverseOf('entrada');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEtiquetas()
    {
        return $this->hasMany(Etiqueta::className(), ['id' => 'etiqueta_id'])->via('entradaEtiquetas');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasMany(User::className(), ['user_id' => 'id'])->inverseOf('entradas');
    }
}
