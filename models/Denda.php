<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "denda".
 *
 * @property int $id
 * @property int $id_peminjaman
 */
class Denda extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'denda';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_peminjaman'], 'required'],
            [['id_peminjaman'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_peminjaman' => 'Id Peminjaman',
        ];
    }
}
