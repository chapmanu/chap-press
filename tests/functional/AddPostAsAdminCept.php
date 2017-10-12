<?php

/*
  Functional Tests -  Functional tests allows sending GET, POST, PUT and DELETE requests to the WordPress installation index without requiring a web server. Functional tests don’t require a web server. Acceptance tests do.

  In simple terms we set the $_REQUEST, $_GET and $_POST variables and then we execute the application from a test. This may be valuable, as functional tests are faster and provide detailed stack traces on failures.
 */

$I = new FunctionalTester($scenario);
$I->wantTo("Add a post as an admin");
$I->loginAsAdmin();
$I->amOnPage('/wp-admin/edit.php');
$I->click('Add New');
$I->fillField('#title','Title of Post');
$I->fillField('#content','Sample Text inside body element');
$I->amGoingTo('submit a post as a admin');
$I->click( 'Publish' );