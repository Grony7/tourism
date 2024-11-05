<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Accommodation".
 *
 * @property int $id
 * @property int|null $tourist_id
 * @property int|null $hotel_id
 * @property string|null $room_number
 * @property string|null $check_in_date
 * @property string|null $check_out_date
 */
class Accommodation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Accommodation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tourist_id', 'hotel_id'], 'integer'],
            [['check_in_date', 'check_out_date'], 'safe'],
            [['room_number'], 'string', 'max' => 50],
            [['tourist_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tourist::class, 'targetAttribute' => ['tourist_id' => 'id']],
            [['hotel_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hotel::class, 'targetAttribute' => ['hotel_id' => 'id']],
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
            'hotel_id' => 'ID Отеля',
            'room_number' => 'Номер Комнаты',
            'check_in_date' => 'Дата Заселения',
            'check_out_date' => 'Дата Выселения',
        ];
    }

    public function getTourist()
    {
        return $this->hasOne(Tourist::class, ['id' => 'tourist_id']);
    }

    public function getHotel()
    {
        return $this->hasOne(Hotel::class, ['id' => 'hotel_id']);
    }
}
