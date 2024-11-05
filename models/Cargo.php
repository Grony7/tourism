<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Cargo".
 *
 * @property int $id
 * @property int|null $tourist_id
 * @property int $number_of_pieces
 * @property float $weight
 * @property float|null $volume_weight
 * @property float|null $packaging_cost
 * @property float|null $insurance_cost
 * @property float $total_cost
 * @property string|null $markings
 */
class Cargo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Cargo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tourist_id', 'number_of_pieces'], 'integer'],
            [['number_of_pieces', 'weight', 'total_cost'], 'required'],
            [['weight', 'volume_weight', 'packaging_cost', 'insurance_cost', 'total_cost'], 'number'],
            [['markings'], 'string', 'max' => 255],
            [['tourist_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tourist::class, 'targetAttribute' => ['tourist_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tourist_id' => 'ID Туриста',
            'number_of_pieces' => 'Количество',
            'weight' => 'Вес',
            'volume_weight' => 'Объемный Вес',
            'packaging_cost' => 'Стоимость Упаковки',
            'insurance_cost' => 'Стоимость Страховки',
            'total_cost' => 'Общая Стоимость',
            'markings' => 'Маркировка',
        ];
    }

    public function getTourist()
    {
        return $this->hasOne(Tourist::class, ['id' => 'tourist_id']);
    }

    public function getFlightCargos()
    {
        return $this->hasMany(FlightCargo::class, ['cargo_id' => 'id']);
    }

    public function getWarehouseRecords()
    {
        return $this->hasMany(WarehouseRecord::class, ['cargo_id' => 'id']);
    }
}


