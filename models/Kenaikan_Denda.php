<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kenaikan_denda".
 *
 * @property int $id
 * @property int $hari
 * @property int $harga
 */
class Kenaikan_Denda extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kenaikan_denda';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hari', 'harga'], 'required'],
            [['hari', 'harga'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hari' => 'Hari',
            'harga' => 'Harga',
        ];
    }
}
