<?php

namespace frontend\tests\functional;

use common\models\User;
use frontend\tests\FunctionalTester;

class SignupCest
{
    /** @var string  */
    protected $formId = '#form-signup';

    /**
     * @param FunctionalTester $I
     */
    public function _before(FunctionalTester $I): void
    {
        $I->amOnRoute('site/signup');
    }

    /**
     * @param FunctionalTester $I
     */
    public function signupWithEmptyFields(FunctionalTester $I): void
    {
        $I->see('Signup', 'h1');
        $I->see('Please fill out the following fields to signup:');
        $I->submitForm($this->formId, []);
        $I->seeValidationError('Username cannot be blank.');
        $I->seeValidationError('Email cannot be blank.');
        $I->seeValidationError('Password cannot be blank.');

    }

    /**
     * @param FunctionalTester $I
     */
    public function signupWithWrongEmail(FunctionalTester $I): void
    {
        $I->submitForm(
            $this->formId, [
                'SignupForm[username]' => 'tester',
                'SignupForm[email]' => 'ttttt',
                'SignupForm[password]' => 'tester_password',
            ]
        );
        $I->dontSeeValidationError('Username cannot be blank.');
        $I->dontSeeValidationError('Password cannot be blank.');
        $I->seeValidationError('Email is not a valid email address.');
    }

    /**
     * @param FunctionalTester $I
     */
    public function signupSuccessfully(FunctionalTester $I): void
    {
        $I->submitForm($this->formId, [
            'SignupForm[username]' => 'tester',
            'SignupForm[email]' => 'tester.email@example.com',
            'SignupForm[password]' => 'tester_password',
        ]);

        $I->seeRecord(User::class, [
            'username' => 'tester',
            'email' => 'tester.email@example.com',
        ]);

        $I->see('Logout (tester)', 'form button[type=submit]');
    }
}
