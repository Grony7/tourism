<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TouristFlight".
 *
 * @property int $id
 * @property int|null $tourist_id
 * @property int|null $flight_id
 */
class TouristFlight extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TouristFlight';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tourist_id', 'flight_id'], 'integer'],
            [['tourist_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tourist::class, 'targetAttribute' => ['tourist_id' => 'id']],
            [['flight_id'], 'exist', 'skipOnError' => true, 'targetClass' => Flight::class, 'targetAttribute' => ['flight_id' => 'id']],
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
            'flight_id' => 'ID Рейса',
        ];
    }

    public function getTourist()
    {
        return $this->hasOne(Tourist::class, ['id' => 'tourist_id']);
    }

    public function getFlight()
    {
        return $this->hasOne(Flight::class, ['id' => 'flight_id']);
    }
}
