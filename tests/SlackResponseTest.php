<?php

include './autoload.php';

use HybridLogic\Slack\SlackResponse;

/**
 * Slack Response Test
 *
 * @package default
 * @author Luke Lanchester
 **/
class SlackResponseTest extends PHPUnit_Framework_TestCase {


	/**
	 * Test initializing a base response
	 *
	 * @return void
	 **/
	public function testInitResponse() {

		$response = new SlackResponse;

		$this->assertInstanceOf('HybridLogic\Slack\SlackResponse', $response);

	}



}
