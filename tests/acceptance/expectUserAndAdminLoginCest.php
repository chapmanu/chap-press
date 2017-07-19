<?php
/*
 Cest is a class based format. Cest format is able to support multiple 
 tests per file and easy reuse of code by adding additional private functions.
 Cest combines scenario-driven test approach with OOP design. 
 */

class expectUserAndAdminLoginCest
{
    public function _before(AcceptanceTester $I)
    {
        //runs before each test
        $I->amOnPage('/');

    }

    public function _after(AcceptanceTester $I)
    {
        //runs after each test
    }

    // tests
    
    public function expectsUserToLogin(AcceptanceTester $I) {
        $I->wantTo('log in as a user');
        $I->loginAs('chappress', 'password');
    }

    public function expectsAdminToLogin(AcceptanceTester $I) {
        $I->wantTo('log in as an Admin');
        $I->loginAsAdmin();
        $I->amOnPage('/wp-admin/index.php');
    }

    function expectsAddNewUser(AcceptanceTester $I)
    {
        $I->wantTo('login as an Admin and add a new user');
        $I->amGoingTo('log in as Admin');
        $I->loginAsAdmin();
        $I->amOnPage('/wp-admin/user-new.php');
        $I->fillField('Username', 'chappress-user');
        $I->fillField('Email', 'chappress@gmail.com');
        $I->amGoingTo('submit form and add new user');
        $I->click('Add New User');
    }


}
