<?php 
/* The Cept format is simple way to structure the test code. 
   It uses simple methods and line-by-line instruction. 
   
   Create the scenario first: $I = new AcceptanceTester($scenario);

   Continue with line-by-line instruction using predefined methods.
   
   http://codeception.com/docs/modules/PhpBrowser 
*/

$I = new AcceptanceTester($scenario);
$I->wantTo('log in as an Admin and activate plugin');
$I->loginAsAdmin();
$I->amOnPluginsPage();
$I->seeInCurrentUrl('/wp-admin/plugins.php');
$I->amGoingTo('activate plugin');
$I->activatePlugin('akismet');
$I->amGoingTo('check if plugin is activated');
$I->seePluginActivated('akismet');



