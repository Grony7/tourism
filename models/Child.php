<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Child".
 *
 * @property int $id
 * @property string $full_name
 * @property int $age
 * @property int $parent_id
 */
class Child extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Child';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['full_name', 'age', 'parent_id'], 'required'],
            [['age', 'parent_id'], 'integer'],
            [['full_name'], 'string', 'max' => 255],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tourist::class, 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'Полное Имя',
            'age' => 'Возраст',
            'parent_id' => 'ID Родителя',
        ];
    }

    public function getParent()
    {
        return $this->hasOne(Tourist::class, ['id' => 'parent_id']);
    }
}
