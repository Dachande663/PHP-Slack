<?php

include './autoload.php';

use HybridLogic\Slack\SlashRequest;

/**
 * Slash Request Test
 *
 * @package default
 * @author Luke Lanchester
 **/
class SlashRequestTest extends PHPUnit_Framework_TestCase {


	/**
	 * Test initializing a base request
	 *
	 * @return void
	 **/
	public function testInitRequest() {

		$request = new SlashRequest([]);

		$this->assertInstanceOf('HybridLogic\Slack\SlashRequest', $request);

	}



}
