<?php

class expectAdminToAddUserCest
{
    public function expectsAddNewUser(AcceptanceTester $I) {
        $I->wantTo('login as an Admin and add a new user');
        $I->amGoingTo('log in as Admin');
        $I->loginAsAdmin();
        $I->amOnPage('/wp-admin/user-new.php');
        $I->fillField('Username', 'chappress-test-user');
        $I->fillField('Email', 'chappress-test-user@chappress.com');
        $I->amGoingTo('submit form and add new user');
        $I->click('Add New User');
    }
}