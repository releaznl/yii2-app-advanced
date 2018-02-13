<?php

namespace common\components\db;
use yii\behaviors\TimestampBehavior;
use common\components\behavior\CreatedUpdatedBehavior;
use common\models\User;
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
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
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