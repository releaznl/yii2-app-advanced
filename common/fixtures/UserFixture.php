<?php
namespace common\fixtures;

use yii\test\ActiveFixture;
use common\models\User;

class UserFixture extends ActiveFixture
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->modelClass = User::class;

        parent::init();
    }
}