<?php
/*
 Cest is a class based format. Cest format is able to support multiple 
 tests per file and easy reuse of code by adding additional private functions.
 Cest combines scenario-driven test approach with OOP design. 
 */

class expectUserAndAdminLoginCest
{
    public function _before(AcceptanceTester $I) {
        //runs before each test
        $I->amOnPage('/');
    }

    public function _after(AcceptanceTester $I) {
        //runs after each test
    }

    // tests
    
    public function expectsUserToLogin(AcceptanceTester $I) {
        $I->wantTo('log in as a user');
        $I->loginAs('chappress_test', 'password');
    }

    public function expectsAdminToLogin(AcceptanceTester $I) {
        $I->wantTo('log in as an Admin');
        $I->loginAsAdmin();
        $I->amOnPage('/wp-admin/index.php');
    }
}
