<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "FinancialItem".
 *
 * @property int $id
 * @property int|null $report_id
 * @property string $item_type
 * @property string $category
 * @property float $amount
 */
class FinancialItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'FinancialItem';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['report_id'], 'integer'],
            [['item_type', 'category', 'amount'], 'required'],
            [['item_type'], 'string'],
            [['amount'], 'number'],
            [['report_date'], 'safe'],
            [['category'], 'string', 'max' => 100],
            [['report_id'], 'exist', 'skipOnError' => true, 'targetAttribute' => ['report_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'report_id' => 'ID Отчета',
            'item_type' => 'Тип Статьи',
            'category' => 'Категория',
            'amount' => 'Сумма',
        ];
    }

    public function getReport()
    {
        return $this->hasOne(FinancialReport::class, ['id' => 'report_id']);
    }

    public function getTouristGroup()
    {
        return $this->hasOne(TouristGroup::class, ['id' => 'group_id']);
    }
}


