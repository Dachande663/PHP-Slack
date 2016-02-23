<?php

namespace HybridLogic\Slack;

/**
 * Slash Command Interface
 *
 * @package HybridLogic\Slack
 * @author Luke Lanchester
 **/
interface SlashCommandInterface {


	/**
	 * Get the slash command token
	 *
	 * @return string Slash command token
	 **/
	public function token();


	/**
	 * Execute a command with the given input
	 *
	 * @param HybridLogic\Slack\SlashRequest
	 * @return HybridLogic\Slack\SlackResponse
	 **/
	public function execute(SlashRequest $request);


}
