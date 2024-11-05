<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "WarehouseRecord".
 *
 * @property int $id
 * @property int|null $cargo_id
 * @property int|null $warehouse_id
 * @property string $date_received
 * @property string|null $date_shipped
 */
class WarehouseRecord extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'WarehouseRecord';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cargo_id', 'warehouse_id'], 'integer'],
            [['date_received'], 'required'],
            [['date_received', 'date_shipped'], 'safe'],
            [['cargo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cargo::class, 'targetAttribute' => ['cargo_id' => 'id']],
            [['warehouse_id'], 'exist', 'skipOnError' => true, 'targetClass' => Warehouse::class, 'targetAttribute' => ['warehouse_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cargo_id' => 'ID Груза',
            'warehouse_id' => 'ID Склада',
            'date_received' => 'Дата Поступления',
            'date_shipped' => 'Дата Отправки',
        ];
    }

    public function getCargo()
    {
        return $this->hasOne(Cargo::class, ['id' => 'cargo_id']);
    }

    public function getWarehouse()
    {
        return $this->hasOne(Warehouse::class, ['id' => 'warehouse_id']);
    }
}
