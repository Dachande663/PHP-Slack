<?php

include './autoload.php';

use HybridLogic\Slack\SlashCommand;

if(!class_exists('ExampleSlashClosureCommand')) {
class ExampleSlashCommand extends SlashCommand {

}
}

/**
 * Slash Command Test
 *
 * @package default
 * @author Luke Lanchester
 **/
class SlashCommandTest extends PHPUnit_Framework_TestCase {


	/**
	 * Test initializing a base command
	 *
	 * @return void
	 **/
	public function testInitCommand() {

		$command = new ExampleSlashCommand;

		$this->assertInstanceOf('HybridLogic\Slack\SlashCommand', $command);

	}



}
