<?php
namespace frontend\tests\unit\models;

use common\fixtures\UserFixture;
use common\models\User;
use frontend\models\SignupForm;
use Codeception\Test\Unit;

class SignupFormTest extends Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;

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

    public function testCorrectSignup(): void
    {
        $model = new SignupForm([
            'username' => 'some_username',
            'email' => 'some_email@example.com',
            'password' => 'some_password',
        ]);

        $user = $model->signup();

        expect($user)->isInstanceOf(User::class);

        expect($user->username)->equals('some_username');
        expect($user->email)->equals('some_email@example.com');
        expect($user->validatePassword('some_password'))->true();
    }

    public function testNotCorrectSignup(): void
    {
        $model = new SignupForm([
            'username' => 'troy.becker',
            'email' => 'nicolas.dianna@hotmail.com',
            'password' => 'some_password',
        ]);

        expect_not($model->signup());
        expect_that($model->getErrors('username'));
        expect_that($model->getErrors('email'));

        expect($model->getFirstError('username'))
            ->equals('This username has already been taken.');
        expect($model->getFirstError('email'))
            ->equals('This email address has already been taken.');
    }
}
