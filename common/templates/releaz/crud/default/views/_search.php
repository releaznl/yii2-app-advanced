<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->searchModelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-search">

	<?= "<?php " ?>$form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

<?php
$count = 0;
foreach ($generator->getColumnNames() as $attribute) {

	if(!in_array($attribute, ['created_by', 'updated_by', 'created_at', 'updated_at']))
	{
		if (++$count < 6) {
			echo "\t<?= " . $generator->generateActiveSearchField($attribute) . " ?>\n\n";
		} else {
			echo "\t<?php // echo " . $generator->generateActiveSearchField($attribute) . " ?>\n\n";
		}
	}
}
?>
	<div class="form-group">
		<?= "<?= " ?>Html::submitButton(Yii::t('common', 'Search'), ['class' => 'btn btn-primary']) ?>
		<?= "<?= " ?>Html::resetButton(Yii::t('common', 'Reset'), ['class' => 'btn btn-default']) ?>
	</div>

	<?= "<?php " ?>ActiveForm::end(); ?>

</div>
