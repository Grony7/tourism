<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Visa".
 *
 * @property int $id
 * @property int|null $tourist_id
 * @property string $visa_number
 * @property string $issue_date
 * @property string $expiry_date
 */
class Visa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Visa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tourist_id'], 'integer'],
            [['visa_number', 'issue_date', 'expiry_date'], 'required'],
            [['issue_date', 'expiry_date'], 'safe'],
            [['visa_number'], 'string', 'max' => 100],
            [['tourist_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tourist::class, 'targetAttribute' => ['tourist_id' => 'id']],
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
            'visa_number' => 'Номер Визы',
            'issue_date' => 'Дата Выдачи',
            'expiry_date' => 'Дата Истечения',
        ];
    }

    public function getTourist()
    {
        return $this->hasOne(Tourist::class, ['id' => 'tourist_id']);
    }
}
