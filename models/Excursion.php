<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Excursion".
 *
 * @property int $id
 * @property string $excursion_name
 * @property string|null $description
 * @property int|null $agency_id
 */
class Excursion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Экскурсии';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['excursion_name'], 'required'],
            [['description'], 'string'],
            [['agency_id'], 'integer'],
            [['excursion_name'], 'string', 'max' => 255],
            [['agency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Excursionagency::class, 'targetAttribute' => ['agency_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'excursion_name' => 'Название Экскурсии',
            'description' => 'Описание',
            'agency_id' => 'ID Агентства',
        ];
    }

    public function getAgency()
    {
        return $this->hasOne(ExcursionAgency::class, ['id' => 'agency_id']);
    }

    public function getExcursionBookings()
    {
        return $this->hasMany(ExcursionBooking::class, ['excursion_id' => 'id']);
    }
}
