<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Tourist".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $patronymic
 * @property string $passport_data
 * @property string $gender
 * @property string $birth_date
 * @property int|null $has_children
 * @property int|null $group_id
 * @property string|null $trip_purpose
 */
class Tourist extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Tourist';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'patronymic', 'passport_data', 'gender', 'birth_date'], 'required', 'message' => 'Поле обязательно к заполнению'],
            [['gender', 'trip_purpose'], 'string'],
            [['birth_date'], 'date', 'format' => 'php:Y-m-d', 'message' => '{attribute} должна быть в формате ДД.ММ.ГГГГ'],
            [['has_children'], 'boolean'],
            [['name', 'surname', 'patronymic'], 'string', 'max' => 255],
            [['passport_data'], 'string', 'max' => 100],
            [['group_id'], 'integer'],
            [['trip_purpose'], 'in', 'range' => ['Отдых', 'Шопинг']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'passport_data' => 'Паспортные Данные',
            'gender' => 'Пол',
            'birth_date' => 'Дата Рождения',
            'has_children' => 'Наличие Детей',
            'group_id' => 'Группа',
            'trip_purpose' => 'Цель поездки',
        ];
    }

    public function getAccommodations()
    {
        return $this->hasMany(Accommodation::class, ['tourist_id' => 'id']);
    }

    public function getCargos()
    {
        return $this->hasMany(Cargo::class, ['tourist_id' => 'id']);
    }

    public function getChildren()
    {
        return $this->hasMany(Child::class, ['parent_id' => 'id']);
    }

    public function getExcursionBookings()
    {
        return $this->hasMany(ExcursionBooking::class, ['tourist_id' => 'id']);
    }

    public function getTouristFlights()
    {
        return $this->hasMany(TouristFlight::class, ['tourist_id' => 'id']);
    }

    public function getVisas()
    {
        return $this->hasMany(Visa::class, ['tourist_id' => 'id']);
    }

    /**
     * Прямая связь с таблицей TouristGroup
     */
    public function getGroup()
    {
        return $this->hasOne(TouristGroup::class, ['id' => 'group_id']);
    }
}
