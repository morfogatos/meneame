<?php

namespace app\models;

use phpDocumentor\Reflection\Types\Boolean;

/**
 * This is the model class for table "etiquetas".
 *
 * @property integer $id
 * @property string $nombre
 *
 * @property EntradasEtiquetas[] $entradasEtiquetas
 */
class Etiqueta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'etiquetas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Etiquetas',
        ];
    }

    /**
     * Guarda todas las etiquetas separadas y luego las asigna a su entrada
     * @param  Entrada $entrada la entrada con las etiquetas
     * @return Boolean true o false dependiendo de si se pudo completar con exito
     */
    public function guardar($entrada)
    {
        $etiquetas = explode(',', $this->nombre);

        foreach ($etiquetas as $etiqueta) {
            $etiqueta = trim($etiqueta);
            if ($etiqueta === '') {
                continue;
            }

            $etiquetaGuardar = new Etiqueta;
            $etiquetaGuardar->nombre = $etiqueta;
            $etiquetaGuardar->save();

            $entradaEtiqueta = new EntradaEtiqueta;
            $entradaEtiqueta->entrada_id = $entrada->id;
            $entradaEtiqueta->etiqueta_id = $etiquetaGuardar->id;

            $entradaEtiqueta->save();
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntradaEtiquetas()
    {
        return $this->hasMany(EntradaEtiqueta::className(), ['etiqueta_id' => 'id'])->inverseOf('etiqueta');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntradas()
    {
        return $this->hasMany(Entrada::className(), ['id' => 'entrada_id'])->via('entradaEtiquetas');
    }
}
