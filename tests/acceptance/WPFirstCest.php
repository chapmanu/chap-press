<?php


class WPFirstCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    { 
        $I->amOnPage('/');
        $I->loginAsAdmin();
        $I->amOnPage( '/wp-admin' );
        $I->see('Plugins');
        $I->click( 'Plugins');
        $I->amOnPage('/wp-admin/plugins.php');
        $I->see('Hello Dolly');
        
        
        // $I->isPopulated();

    }
}
