<?php

namespace frontend\tests\unit\models;

use Codeception\Test\Unit;
use common\fixtures\UserFixture;
use frontend\models\ResetPasswordForm;
use yii\base\InvalidParamException;

class ResetPasswordFormTest extends Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;

    public function _fixtures(): array
    {
        return [
            'user' => [
                'class' => UserFixture::class,
            ]
        ];
    }

    public function testResetWrongToken(): void
    {
        $this->tester->expectException(InvalidParamException::class, function () {
            new ResetPasswordForm('');
        });

        $this->tester->expectException(InvalidParamException::class, function () {
            new ResetPasswordForm('notexistingtoken_1391882543');
        });
    }

    public function testResetCorrectToken(): void
    {
        $user = $this->tester->grabFixture('user', 0);
        $form = new ResetPasswordForm($user['password_reset_token']);
        expect_that($form->resetPassword());
    }

}
