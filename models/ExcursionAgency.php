<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ExcursionAgency".
 *
 * @property int $id
 * @property string $agency_name
 * @property string|null $contact_info
 * @property float|null $rating
 */
class ExcursionAgency extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ExcursionAgency';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['agency_name'], 'required'],
            [['rating'], 'number'],
            [['agency_name', 'contact_info'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'agency_name' => 'Название Агентства',
            'contact_info' => 'Контактная Информация',
            'rating' => 'Рейтинг',
        ];
    }

    public function getExcursions()
    {
        return $this->hasMany(Excursion::class, ['agency_id' => 'id']);
    }
}
