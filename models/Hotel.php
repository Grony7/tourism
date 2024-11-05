<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Hotel".
 *
 * @property int $id
 * @property string $hotel_name
 * @property string|null $address
 * @property int $total_rooms
 */
class Hotel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Hotel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hotel_name', 'total_rooms'], 'required'],
            [['total_rooms'], 'integer'],
            [['hotel_name', 'address'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hotel_name' => 'Название Отеля',
            'address' => 'Адрес',
            'total_rooms' => 'Общее Количество Комнат',
        ];
    }

    public function getAccommodations()
    {
        return $this->hasMany(Accommodation::class, ['hotel_id' => 'id']);
    }
}
