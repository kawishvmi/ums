<?php

namespace tests\functional;

use yii\helpers\Url;
use Codeception\Actor;

class SiteLoginCest
{
    public function loginWithValidCredentials(AcceptanceTester $I)
    {
        $I->amOnPage(Url::to(['/site/login']));
        $I->fillField('Username', 'validUser');
        $I->fillField('Password', 'validPassword');
        $I->click('Login');
        $I->see('Welcome');
    }

    public function loginWithInvalidCredentials(AcceptanceTester $I)
    {
        $I->amOnPage(Url::to(['/site/login']));
        $I->fillField('Username', 'invalidUser');
        $I->fillField('Password', 'invalidPassword');
        $I->click('Login');
        $I->see('Invalid username or password');
    }


    public function loginAsAdmin(AcceptanceTester $I)
    {
        $I->amOnPage(Url::to(['/site/login']));
        $I->fillField('Username', 'adminUser');
        $I->fillField('Password', 'adminPassword');
        $I->click('Login');
        $I->seeInCurrentUrl('/admin/profile');
    }

    public function loginAsRegularUser(AcceptanceTester $I)
    {
        $I->amOnPage(Url::to(['/site/login']));
        $I->fillField('Username', 'regularUser');
        $I->fillField('Password', 'regularPassword');
        $I->click('Login');
        $I->seeInCurrentUrl('/user/profile');
    }
}
