<?php
/**
 * @copyright Bluz PHP Team
 * @link https://github.com/bluzphp/framework
 */

/**
 * @namespace
 */
namespace Bluz\Tests;

use Bluz;
use Bluz\Http;
use Bluz\Request\AbstractRequest;
use Bluz\Response\AbstractResponse;

/**
 * ControllerTestCase
 *
 * @category Bluz
 * @package  Tests
 *
 * @author   Anton Shevchuk
 * @created  04.08.11 20:01
 */
class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * Application entity
     *
     * @var \Application\Tests\BootstrapTest
     */
    private $app;

    /**
     * Get Application instance
     *
     * @return BootstrapTest
     */
    protected function getApp()
    {
        if (!$this->app) {
            $env = getenv('BLUZ_ENV') ?: 'testing';

            $this->app = BootstrapTest::getInstance();
            $this->app->init($env);
        }

        return $this->app;
    }

    /**
     * Reset layout and Request
     */
    protected function resetApp()
    {
        if ($this->app) {
            $this->app->resetLayout();
            $this->app->getAuth()->clearIdentity();
            $this->app->setRequest(new Http\Request());
            $this->app->setResponse(new Http\Response());
            $this->app->useJson(false);
            $this->app->useLayout(true);
            $this->app->getMessages()->popAll();
        }
    }

    /**
     * Assert Array Size
     * @param array|\ArrayObject $array
     * @param integer $size
     * @param string $message
     */
    protected function assertArrayHasSize($array, $size, $message = null)
    {
        $this->assertEquals(
            $size,
            sizeof($array),
            $message ?: 'Failed asserting that array has size '.$size.' matches expected '.sizeof($array). '.'
        );
    }

    /**
     * Assert Array Key has Size
     * @param array|\ArrayObject $array
     * @param string $key
     * @param integer $size
     * @param string $message
     */
    protected function assertArrayHasKeyAndSize($array, $key, $size, $message = null)
    {
        if (!$message) {
            $message = 'Failed asserting that array has key '.$key.' with size '.$size
                . ' matches expected '.sizeof($array). '.';
        }

        $this->assertArrayHasKey($key, $array, $message);
        $this->assertEquals($size, sizeof($array[$key]), $message);
    }
}
