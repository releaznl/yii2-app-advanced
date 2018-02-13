<?php

namespace common\components\db;

use common\components\behavior\CreatedUpdatedBehavior;
use common\components\behavior\SoftDeleteBehavior;
use common\models\User;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;

/**
 * Class DeleteActiveRecord
 */
class DeleteActiveRecord extends ReleazActiveRecord
{
    const DELETE_ATTRIBUTE = 'deleted_at';

    /**
     * Override default find() method so we exclude the deleted models
     * @return \yii\db\ActiveQuery|DeleteActiveRecord
     */
    public static function find()
    {
        return new DeletedQuery(self::tableName(), static::class);
    }

    /**
     * @return \yii\db\ActiveQuery|DeleteActiveRecord
     */
    public static function findDeleted()
    {
        return parent::find()
            ->where(['NOT', [self::tableName() . '.' . self::DELETE_ATTRIBUTE => null]]);
    }

    /**
     * @inheritdoc
     */
    public function behaviors(): array
    {
        return [
            TimestampBehavior::className(),
            CreatedUpdatedBehavior::className(),
            'softDeleteBehavior' => [
                'class' => SoftDeleteBehavior::class,
                'attribute' => self::DELETE_ATTRIBUTE,
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeletedBy(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'deleted_by']);
    }
}
