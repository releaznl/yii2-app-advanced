<?php

namespace common\components\db;

use common\components\behavior\CreatedUpdatedBehavior;
use common\components\behavior\SoftDeleteBehavior;
use common\models\User;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;

/**
 * Class ActiveRecord
 * @package common\components\db
 */
class ActiveRecord extends \yii\db\ActiveRecord
{
    const DELETE_ATTRIBUTE = 'deleted_at';

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
            'softDeleteBehavior' => [
                'class' => SoftDeleteBehavior::class,
                'attribute' => self::DELETE_ATTRIBUTE,
            ],

        ];
    }

    /**
     * Override default find() method so we exclude the deleted models
     * @return ActiveQuery
     */
    public static function find(): ActiveQuery
    {
        return parent::find()->where([self::tableName() . '.' . self::DELETE_ATTRIBUTE => null]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(): array
    {
        return array_merge(parent::attributeLabels(), [
            'id' => \Yii::t('common', 'ID'),
            'created_by' => \Yii::t('common', 'Created By'),
            'updated_by' => \Yii::t('common', 'Updated By'),
            'created_at' => \Yii::t('common', 'Created At'),
            'updated_at' => \Yii::t('common', 'Updated At'),
            self::DELETE_ATTRIBUTE => \Yii::t('common', 'Deleted At'),
        ]);
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

    /**
     * Creates a new model or returns the found one if present
     * @param $attributes
     * @return null|static
     */
    public static function findOrNew($attributes)
    {
        $model = self::findOne($attributes);
        if ($model === null) {
            $class = self::class;
            $model = new $class($attributes);
        }

        return $model;

    }

}