<?php

namespace HybridLogic\Slack;

/**
 * Slash Command Dispatcher
 *
 * @package HybridLogic\Slack
 * @author Luke Lanchester
 **/
class SlashDispatcher {


	/**
	 * @var HybridLogic\Slack\SlashFilter
	 **/
	protected $filter;


	/**
	 * @var array Slash commands
	 **/
	protected $commands = [];


	/**
	 * @var string Token auth error message
	 **/
	protected $token_error_msg = ":exclamation: You've got to prove who you are before I'll talk.";


	/**
	 * @var string Command 404 error message
	 **/
	protected $command_error_msg = ":confounded: I don't know that command.";


	/**
	 * Add a command
	 *
	 * @param HybridLogic\Slack\SlashCommandInterface
	 * @return self
	 **/
	public function addCommand(SlashCommandInterface $command) {

		$this->commands[$command->token()] = $command;

		return $this;

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
	 * Dispatch slash commands
	 *
	 * @param HybridLogic\Slack\SlashRequest
	 * @return HybridLogic\Slack\SlackResponse
	 **/
	public function dispatch(SlashRequest $request) {

		if($this->filter !== null and $response = $this->filter->checkResponse($request)) {
			return $response;
		}

		$token = $request->token();

		if(empty($token)) {
			return new SlackResponse($this->token_error_msg);
		}

		if(empty($this->commands[$token])) {
			return new SlackResponse($this->command_error_msg);
		}

		$command = $this->commands[$token];

		return $command->execute($request);

	}



}
