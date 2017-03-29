<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class CustomCest
{
    public function checkOpen(FunctionalTester $tester)
    {
        $tester->amOnPage(\Yii::$app->homeUrl);
        $tester->see('Go to custom guide');
        $tester->click('Go to custom guide');
        $tester->see("Welcome to the custom guide!");
    }

}
