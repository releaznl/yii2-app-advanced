<?php
namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class CustomCest
{

    public function checkUploadsImage(AcceptanceTester $tester)
    {
        $tester->amOnPage(Url::to(['/custom/index']));

        // Xpath usage on image element
        $tester->seeElement("//img[@src='uploads/download.png']");
    }

    public function checkBackend(AcceptanceTester $tester)
    {
        $tester->amOnPage(Url::to(['/custom/index']));

        $tester->click('this');

        $tester->wait(1);

        $tester->seeElement("//div[@class='site-login']/h1");
    }
}
