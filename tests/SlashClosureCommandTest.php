<?php

include './autoload.php';

use HybridLogic\Slack\SlashClosureCommand;

/**
 * Slash Closure Command Test
 *
 * @package default
 * @author Luke Lanchester
 **/
class SlashClosureCommandTest extends PHPUnit_Framework_TestCase {


	/**
	 * Test initializing a base closure command
	 *
	 * @return void
	 **/
	public function testInitCommand() {

		$command = new SlashClosureCommand('example-token');

		$this->assertInstanceOf('HybridLogic\Slack\SlashClosureCommand', $command);

	}



}
