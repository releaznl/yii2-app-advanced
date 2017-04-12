<?php
namespace common\components\db;

use common\components\behavior\CreatedUpdatedBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;

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
        return new DeletedQuery(self::tableName(), get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery|DeleteActiveRecord
     */
    public static function findDeleted()
    {
        return parent::find()
            ->where(['NOT', [self::tableName() . '.' . self::DELETE_ATTRIBUTE=> null]])
            ->andWhere(['organization_id' => Yii::$app->user->identity->organizationId]);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            CreatedUpdatedBehavior::className(),
            'softDeleteBehavior' => [
                'class'     => \common\components\behavior\SoftDeleteBehavior::className(),
                'attribute' => self::DELETE_ATTRIBUTE,
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeletedBy()
    {
        return $this->hasOne(\common\models\User::className(), ['id' => 'deleted_by']);
    }
}
