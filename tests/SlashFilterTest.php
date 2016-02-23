<?php

include './autoload.php';

use HybridLogic\Slack\SlashFilter;

/**
 * Slash Filter Test
 *
 * @package default
 * @author Luke Lanchester
 **/
class SlashFilterTest extends PHPUnit_Framework_TestCase {


	/**
	 * Test initializing a base filter
	 *
	 * @return void
	 **/
	public function testInitFilter() {

		$filter = new SlashFilter;

		$this->assertInstanceOf('HybridLogic\Slack\SlashFilter', $filter);

	}



}
