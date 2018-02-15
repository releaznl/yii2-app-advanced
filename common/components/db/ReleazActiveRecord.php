<?php

namespace common\components\db;

use common\components\behavior\CreatedUpdatedBehavior;
use common\models\User;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;

class ReleazActiveRecord extends \yii\db\ActiveRecord
{
    const BOOL_NO = 0;
    const BOOL_YES = 1;

    /**
     * Fix the decimals, used with prices and hours
     * @param $attribute
     * @return mixed
     */
    protected function fixDecimal($attribute)
    {
        return str_replace(',', '.', $attribute);
    }

    /**
     * @inheritdoc
     */
    public function behaviors(): array
    {
        return [
            TimestampBehavior::class,
            CreatedUpdatedBehavior::class,
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(): array
    {
        return array_merge(parent::attributeLabels(), [
            'id' => Yii::t('common', 'ID'),
            'created_by' => Yii::t('common', 'Created By'),
            'updated_by' => Yii::t('common', 'Updated By'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
            'deleted_at' => Yii::t('common', 'Deleted At'),
        ]);
    }

    /**
     * @return ActiveQuery
     */
    public function getUpdatedBy(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

    /**
     * @return ActiveQuery
     */
    public function getCreatedBy(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * @param $date
     * @return bool|string
     */
    public function fixDate($date)
    {
        return date('Y-m-d', strtotime($date));
    }
}