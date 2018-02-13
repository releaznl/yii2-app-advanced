<?php

namespace common\components\bootstrap;

/**
 * Class ActiveForm
 * @package common\components\bootstrap
 */
class ActiveForm extends \yii\bootstrap\ActiveForm
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->layout = 'horizontal';

        parent::init();
    }
}
