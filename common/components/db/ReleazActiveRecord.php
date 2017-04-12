<?php
namespace common\components\db;

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
		return str_replace(",", ".", $attribute);
	}

	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			\yii\behaviors\TimestampBehavior::className(),
			\common\components\behavior\CreatedUpdatedBehavior::className(),
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUpdatedBy()
	{
		return $this->hasOne(\common\models\User::className(), ['id' => 'updated_by']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCreatedBy()
	{
		return $this->hasOne(\common\models\User::className(), ['id' => 'created_by']);
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