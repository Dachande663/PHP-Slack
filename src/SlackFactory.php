<?php

namespace HybridLogic\Slack;

/**
 * Slack Command Factory
 *
 * @package HybridLogic\Slack
 * @author Luke Lanchester
 **/
class SlackFactory {


	/**
	 * Make a closure-based command
	 *
	 * @param string Command slash token
	 * @return HybridLogic\Slack\SlashClosureCommand
	 **/
	public static function command($token) {

		return new SlashClosureCommand($token);

	}



	/**
	 * Make a dispatcher
	 *
	 * @return HybridLogic\Slack\SlashDispatcher
	 **/
	public static function dispatcher() {

		return new SlashDispatcher;

	}



	/**
	 * Make a filter
	 *
	 * @return HybridLogic\Slack\SlashFilter
	 **/
	public static function filter() {

		return new SlashFilter;

	}



	/**
	 * Make a request
	 *
	 * @return HybridLogic\Slack\SlashRequest
	 **/
	public static function request(array $input = null) {

		if($input === null) {
			$input = $_POST;
		}

		return new SlashRequest($input);

	}



	/**
	 * Make a response
	 *
	 * @return HybridLogic\Slack\SlackResponse
	 **/
	public static function response($data = null) {

		return new SlackResponse($data);

	}



}
