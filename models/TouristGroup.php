<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TouristGroup".
 *
 * @property int $id
 * @property string $group_name
 * @property string $arrival_date
 * @property string $departure_date
 * @property string $country
 */
class TouristGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TouristGroup';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['group_name', 'arrival_date', 'departure_date', 'country'], 'required'],
            [['arrival_date', 'departure_date'], 'safe'],
            [['group_name', 'country'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_name' => 'Название Группы',
            'arrival_date' => 'Дата Прибытия',
            'departure_date' => 'Дата Отъезда',
            'country' => 'Страна',
        ];
    }

    /**
     * Прямая связь с туристами
     */
    public function getTourists()
    {
        return $this->hasMany(Tourist::class, ['group_id' => 'id']);
    }


    public function getFinancialItems()
    {
        return $this->hasMany(FinancialItem::class, ['group_id' => 'id']);
    }

}
