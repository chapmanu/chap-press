 unitREADME.md


Codeception uses PHPUnit as a backend for running its tests. 
Thus, any PHPUnit test can be added to a Codeception test suite and then executed. 
If you ever wrote a PHPUnit test then do it just as you did before. Codeception adds 
some nice helpers to simplify common tasks.

As you see, unlike in PHPUnit, the setUp and tearDown methods are replaced with their aliases: _before, _after.

The actual setUp and tearDown are implemented by the parent class  \Codeception\TestCase\Test and set the UnitTester class up to have all the actions from Cept-files to be run as a part of your unit tests. 


The extends \Codeception\Test\Unit means that there is full access to all the unit actor methods. You can
access it through the $tester variable.

Rules for test classes extended from Codeception\TestCase\Test are the same as for those extended from PHPUnit_Framework_TestCase - only methods prefixed with test will be run as tests.

//<?php 

// class UserTest extends \Codeception\TestCase\WPTestCase
// {

//     public function setUp()
//     {
//         // before
//         parent::setUp();

//         // your set up methods here
//     }

//     public function tearDown()
//     {
//         // your tear down methods here

//         // then
//         parent::tearDown();
//     }

//     // tests
//     public function testMe()
//     {
//     }

// }