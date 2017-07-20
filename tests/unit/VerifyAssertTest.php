<?php


class VerifyAssertTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    function test_truth() {
        $this->assertTrue( 1 >= 0 );
    }

    function test_string_contains_word() {
        $string = "This requires a test";
        $this->assertContains( 'requires', $string);
    }

    function test_is_string(){
        $string = "this is a string type";
        $this->assertInternalType('string', $string);
    }
}