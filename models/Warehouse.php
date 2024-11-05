<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Warehouse".
 *
 * @property int $id
 * @property string $location
 * @property int $capacity
 */
class Warehouse extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Warehouse';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['location', 'capacity'], 'required'],
            [['capacity'], 'integer'],
            [['location'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'location' => 'Расположение',
            'capacity' => 'Вместимость',
        ];
    }

    public function getWarehouseRecords()
    {
        return $this->hasMany(WarehouseRecord::class, ['warehouse_id' => 'id']);
    }
}
