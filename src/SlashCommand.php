<?php

namespace HybridLogic\Slack;

/**
 * Slash Command
 *
 * @package HybridLogic\Slack
 * @author Luke Lanchester
 **/
abstract class SlashCommand implements SlashCommandInterface{


	/**
	 * @var string Slash command token
	 **/
	protected $token;


	/**
	 * @var HybridLogic\Slack\SlashFilter
	 **/
	protected $filter;


	/**
	 * @var array Patterns and their handlers
	 **/
	protected $patterns = [];


	/**
	 * @var string Error message
	 **/
	protected $error_msg = ":confounded: I didn't quite understand that. Can you try again?";


	/**
	 * Get the slash command token
	 *
	 * @return string Slash command token
	 **/
	public function token() {

		return $this->token;

	}



	/**
	 * Execute a command with the given input
	 *
	 * @param HybridLogic\Slack\SlashRequest
	 * @return HybridLogic\Slack\SlackResponse
	 **/
	public function execute(SlashRequest $request) {

		if($this->filter !== null and $response = $this->filter->checkResponse($request)) {
			return $response;
		}

		$handler = $this->findHandler($request);
		if($handler === null) {
			return new SlackResponse($this->error_msg);
		}

		$response = $this->executeHandler($request, $handler);
		if($response === null) {
			return new SlackResponse($this->error_msg);
		}

		if(!is_a($response, 'HybridLogic\Slack\SlackResponse')) {
			$response = new SlackResponse($response);
		}

		return $response;

	}



	/**
	 * Find handler for pattern
	 *
	 * NB This modifies $request to include params
	 *
	 * @param HybridLogic\Slack\SlashRequest
	 * @return mixed Handler
	 **/
	protected function findHandler(SlashRequest $request) {

		$text = $request->text();

		if($text === null) {
			$text = '';
		}

		if(!empty($this->patterns[$text])) {

			return $this->patterns[$text];

		} else {

			$params = [];

			foreach($this->patterns as $pattern => $cb) {
				if($pattern === '' or preg_match("/$pattern/i", $text, $params) === 0) {
					continue;
				}
				$request->setParams($params);
				return $cb;
			}

		}

		return null;

	}



	/**
	 * Execute the given handler
	 *
	 * @param HybridLogic\Slack\SlashRequest
	 * @param mixed Handler
	 * @return mixed Response
	 **/
	public function executeHandler(SlashRequest $request, $handler) {

		return method_exists($this, $handler) ? $this->$handler($request) : null;

	}



}
