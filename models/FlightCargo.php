<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "FlightCargo".
 *
 * @property int $id
 * @property int|null $flight_id
 * @property int|null $cargo_id
 */
class FlightCargo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'FlightCargo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['flight_id', 'cargo_id'], 'integer'],
            [['flight_id'], 'exist', 'skipOnError' => true, 'targetClass' => Flight::class, 'targetAttribute' => ['flight_id' => 'id']],
            [['cargo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cargo::class, 'targetAttribute' => ['cargo_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'flight_id' => 'ID Рейса',
            'cargo_id' => 'ID Груза',
        ];
    }

    public function getFlight()
    {
        return $this->hasOne(Flight::class, ['id' => 'flight_id']);
    }

    public function getCargo()
    {
        return $this->hasOne(Cargo::class, ['id' => 'cargo_id']);
    }
}
