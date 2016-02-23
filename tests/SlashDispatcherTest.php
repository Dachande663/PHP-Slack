<?php

include './autoload.php';

use HybridLogic\Slack\SlashDispatcher;

/**
 * Slash Dispatcher Test
 *
 * @package default
 * @author Luke Lanchester
 **/
class SlashDispatcherTest extends PHPUnit_Framework_TestCase {


	/**
	 * Test initializing a base dispatcher
	 *
	 * @return void
	 **/
	public function testInitDispatcher() {

		$dispatcher = new SlashDispatcher;

		$this->assertInstanceOf('HybridLogic\Slack\SlashDispatcher', $dispatcher);

	}



}
