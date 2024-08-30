<?php

namespace tests\functional;

use yii\helpers\Url;
use Codeception\Actor;

class AdminUserCest
{
    public function createUser(AcceptanceTester $I)
    {
        $I->amOnPage(Url::to(['/admin/user/create']));
        $I->fillField('Username', 'newUser');
        $I->fillField('Email', 'newuser@example.com');
        $I->fillField('Password', 'password123');
        $I->click('Create');
        $I->see('User has been created');
    }

    public function updateUser(AcceptanceTester $I)
    {
        $I->amOnPage(Url::to(['/admin/user/update', 'id' => 1]));
        $I->fillField('Username', 'updatedUser');
        $I->click('Update');
        $I->see('User has been updated');
    }

    public function deleteUser(AcceptanceTester $I)
    {
        $I->amOnPage(Url::to(['/admin/user/index']));
        $I->click('Delete', '#user-1'); // Adjust selector as needed
        $I->see('Are you sure you want to delete this item?');
        $I->click('Delete');
        $I->dontSee('User 1'); // Adjust as necessary
    }

    public function viewUser(AcceptanceTester $I)
    {
        $I->amOnPage(Url::to(['/admin/user/view', 'id' => 1]));
        $I->see('User Details');
        $I->see('Username');
        $I->see('Email');
    }
}
