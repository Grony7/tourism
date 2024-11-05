<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ExcursionBooking".
 *
 * @property int $id
 * @property int|null $tourist_id
 * @property int|null $excursion_id
 * @property string|null $booking_date
 * @property string|null $excursion_date
 */
class ExcursionBooking extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ExcursionBooking';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tourist_id', 'excursion_id'], 'integer'],
            [['booking_date', 'excursion_date'], 'safe'],
            [['tourist_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tourist::class, 'targetAttribute' => ['tourist_id' => 'id']],
            [['excursion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Excursion::class, 'targetAttribute' => ['excursion_id' => 'id']],
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
            'excursion_id' => 'ID Экскурсии',
            'booking_date' => 'Дата Бронирования',
            'excursion_date' => 'Дата Экскурсии',
        ];
    }

    public function getTourist()
    {
        return $this->hasOne(Tourist::class, ['id' => 'tourist_id']);
    }

    public function getExcursion()
    {
        return $this->hasOne(Excursion::class, ['id' => 'excursion_id']);
    }
}
