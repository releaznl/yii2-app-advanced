<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;
use common\fixtures\UserFixture;

class LoginCest
{
    /**
     * @return array
     */
    public function _fixtures(): array
    {
        return [
            'user' => [
                'class' => UserFixture::class,
            ]
        ];
    }

    /**
     * @param FunctionalTester $I
     */
    public function _before(FunctionalTester $I): void
    {
        $I->amOnRoute('site/login');
    }

    /**
     * @param $login
     * @param $password
     * @return array
     */
    protected function formParams($login, $password): array
    {
        return [
            'LoginForm[username]' => $login,
            'LoginForm[password]' => $password,
        ];
    }

    /**
     * @param FunctionalTester $I
     */
    public function checkEmpty(FunctionalTester $I): void
    {
        $I->submitForm('#login-form', $this->formParams('', ''));
        $I->seeValidationError('Username cannot be blank.');
        $I->seeValidationError('Password cannot be blank.');
    }

    /**
     * @param FunctionalTester $I
     */
    public function checkWrongPassword(FunctionalTester $I): void
    {
        $I->submitForm('#login-form', $this->formParams('admin', 'wrong'));
        $I->seeValidationError('Incorrect username or password.');
    }

    /**
     * @param FunctionalTester $I
     */
    public function checkValidLogin(FunctionalTester $I): void
    {
        $I->submitForm('#login-form', $this->formParams('erau', 'password_0'));
        $I->see('Logout (erau)', 'form button[type=submit]');
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Signup');
    }
}
