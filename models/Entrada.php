<?php

namespace app\models;

use Yii;
use phpDocumentor\Reflection\Types\Integer;
use yii2mod\comments\models\CommentModel;

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
            [['usuario_id', 'categoria_id'], 'integer'],
            [['url'], 'string', 'max' => 255],
            [['url'], 'url', 'defaultScheme' => 'http'],
            [['titulo'], 'string', 'max' => 120],
            [['texto'], 'string', 'max' => 550],
            [['categoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['categoria_id' => 'id']],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuario_id' => 'id']],
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
            'titulo' => 'Titulo de la entrada',
            'texto' => 'Descripción de la entrada',
            'created_at' => 'Fecha de Publicación',
            'categoria_id' => 'Categoria',
            'usuario_id' => 'Usuario ID',
        ];
    }

    public function beforeSave($insert = true)
    {
        if ($insert) {
            $this->usuario_id = Yii::$app->user->id;
        }
        return parent::beforeSave($insert);
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
        return $this->hasOne(User::className(), ['id' => 'usuario_id'])->inverseOf('entradas');
    }

    /**
     * @return Integer
     */
    public function getComentarios()
    {
        return $this->hasMany(CommentModel::className(), ['entityId' => 'id'])->count();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeneos()
    {
        return $this->hasMany(Meneo::className(), ['entrada_id' => 'id'])->inverseOf('entrada');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeneadores()
    {
        return $this->hasMany(User::className(), ['id' => 'usuario_id'])->via('meneos');
    }

    /**
     * @return Integer
     */
    public function getNumeroMeneos()
    {
        return $this->hasMany(Meneo::className(), ['entrada_id' => 'id'])->count();
    }
}
