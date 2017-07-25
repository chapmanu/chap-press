<?php


class DemoUnitTest extends \Codeception\Test\Unit
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
    public function testReportedInterface()
    {
        $this->assertInstanceOf('\\Codeception\\Test\\Interfaces\\Reported', $this);
        $this->assertEquals(array(
            'file' => __FILE__,
            'name' => 'testReportedInterface',
            'class' => 'DemoUnitTest'
        ), $this->getReportFields());
    }
}