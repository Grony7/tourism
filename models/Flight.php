<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Flight".
 *
 * @property int $id
 * @property string $flight_number
 * @property string $flight_date
 * @property string|null $aircraft_type
 * @property int|null $is_cargo_flight
 * @property string $type
 */
class Flight extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Flight';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['flight_number', 'flight_date', 'type'], 'required'],
            [['flight_date'], 'safe'],
            [['flight_number'], 'string', 'max' => 50],
            [['aircraft_type'], 'string', 'max' => 100],
            [['type'], 'in', 'range' => ['грузовой', 'грузопассажирский']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'flight_number' => 'Номер Рейса',
            'flight_date' => 'Дата Рейса',
            'aircraft_type' => 'Тип Самолета',
            'type' => 'Тип Рейса',
        ];
    }

    public function getFlightCargos()
    {
        return $this->hasMany(FlightCargo::class, ['flight_id' => 'id']);
    }

    public function getTouristFlights()
    {
        return $this->hasMany(TouristFlight::class, ['flight_id' => 'id']);
    }


}
