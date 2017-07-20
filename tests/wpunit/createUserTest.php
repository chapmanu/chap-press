<?php


class createUserTest extends \Codeception\TestCase\WPTestCase
{
    /**
     * @var \WpunitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testCreateASingleUserAsAdmin()
    {
		$user_id = $this->factory->user->create( array( 'user_login' => 'test', 'role' => 'administrator' ) );
    }
}

