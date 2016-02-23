<?php

include './autoload.php';

use HybridLogic\Slack\SlackFactory;

/**
 * Slack Factory Test
 *
 * @package default
 * @author Luke Lanchester
 **/
class SlackFactoryTest extends PHPUnit_Framework_TestCase {


	/**
	 * Test making a command
	 *
	 * @return void
	 **/
	public function testCommand() {

		$command = SlackFactory::command('example-token');

		$this->assertInstanceOf('HybridLogic\Slack\SlashClosureCommand', $command);
		$this->assertEquals('example-token', $command->token());

	}



	/**
	 * Test making a dispatcher
	 *
	 * @return void
	 **/
	public function testDispatcher() {

		$dispatcher = SlackFactory::dispatcher();

		$this->assertInstanceOf('HybridLogic\Slack\SlashDispatcher', $dispatcher);

	}



	/**
	 * Test making a filter
	 *
	 * @return void
	 **/
	public function testFilter() {

		$filter = SlackFactory::filter();

		$this->assertInstanceOf('HybridLogic\Slack\SlashFilter', $filter);

	}



	/**
	 * Test making a request
	 *
	 * @return void
	 **/
	public function testRequest() {

		$_POST['token'] = 'example-token-2';

		$request = SlackFactory::request();

		$this->assertInstanceOf('HybridLogic\Slack\SlashRequest', $request);
		$this->assertEquals('example-token-2', $request->token());

	}



	/**
	 * Test making a request with input
	 *
	 * @return void
	 **/
	public function testRequestWithInput() {

		$input = [
			'token' => 'example-token-3',
		];

		$request = SlackFactory::request($input);

		$this->assertInstanceOf('HybridLogic\Slack\SlashRequest', $request);
		$this->assertEquals('example-token-3', $request->token());

	}



	/**
	 * Test making a response
	 *
	 * @return void
	 **/
	public function testResponse() {

		$response = SlackFactory::response();

		$this->assertInstanceOf('HybridLogic\Slack\SlackResponse', $response);

	}



	/**
	 * Test making a response with string
	 *
	 * @return void
	 **/
	public function testResponseWithString() {

		$response = SlackFactory::response('An example string');

		$this->assertInstanceOf('HybridLogic\Slack\SlackResponse', $response);
		$this->assertArraySubset(['text' => 'An example string'], $response->getData());

	}



	/**
	 * Test making a response with data
	 *
	 * @return void
	 **/
	public function testResponseWithData() {

		$response = SlackFactory::response(['text' => 'Another example string']);

		$this->assertInstanceOf('HybridLogic\Slack\SlackResponse', $response);
		$this->assertArraySubset(['text' => 'Another example string'], $response->getData());

	}


}
