<?php

namespace HybridLogic\Slack;

/**
 * Slash Closure Command
 *
 * @package HybridLogic\Slack
 * @author Luke Lanchester
 **/
class SlashClosureCommand extends SlashCommand {


	/**
	 * Constructor
	 *
	 * @param string Slash command token
	 * @return void
	 **/
	public function __construct($token) {

		$this->token = $token;

	}



	/**
	 * Set a filter on this dispatcher
	 *
	 * @param HybridLogic\Slack\SlashFilter
	 * @return self
	 **/
	public function setFilter(SlashFilter $filter) {

		$this->filter = $filter;

		return $this;

	}



	/**
	 * Define a pattern handler
	 *
	 * @param string Pattern
	 * @param Closure Handler
	 * @return self
	 **/
	public function on($pattern, \Closure $callback) {

		$this->patterns[$pattern] = $callback;

		return $this;

	}



	/**
	 * Execute the given handler
	 *
	 * @param HybridLogic\Slack\SlashRequest
	 * @param mixed Handler
	 * @return mixed Response
	 **/
	public function executeHandler(SlashRequest $request, $handler) {

		return $handler($request);

	}



}
