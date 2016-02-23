<?php

namespace HybridLogic\Slack;

/**
 * Slash Command Request
 *
 * @package HybridLogic\Slack
 * @author Luke Lanchester
 **/
class SlashRequest {


	/**
	 * @var array Input data
	 **/
	protected $input;


	/**
	 * @var array Text match params
	 **/
	protected $params = [];


	/**
	 * Constructor
	 *
	 * @param array Input data
	 * @return void
	 **/
	public function __construct(array $input) {

		$this->input = $input;

	}



	/**
	 * Set params from text match
	 *
	 * @param array Params
	 * @return void
	 **/
	public function setParams(array $params) {

		$this->params = $params;

	}



	/**
	 * Get request channel ID
	 *
	 * @return string Channel ID
	 **/
	public function channelId() {

		return !empty($this->input['channel_id']) ? $this->input['channel_id'] : null;

	}



	/**
	 * Get request channel name
	 *
	 * @return string Channel name
	 **/
	public function channelName() {

		return !empty($this->input['channel_name']) ? $this->input['channel_name'] : null;

	}



	/**
	 * Get request command
	 *
	 * @return string Command
	 **/
	public function command() {

		return !empty($this->input['command']) ? $this->input['command'] : null;

	}



	/**
	 * Get a param from text matches
	 *
	 * @param string Key
	 * @param mixed Default
	 * @return string Value
	 **/
	public function param($key = null, $default = null) {

		if($key === null) {
			return $this->params;
		}

		return array_key_exists($key, $this->params) ? $this->params[$key] : $default;

	}



	/**
	 * Get request response url
	 *
	 * @return string Response url
	 **/
	public function responseUrl() {

		return !empty($this->input['response_url']) ? $this->input['response_url'] : null;

	}



	/**
	 * Get request team domain
	 *
	 * @return string Team domain
	 **/
	public function teamDomain() {

		return !empty($this->input['team_domain']) ? $this->input['team_domain'] : null;

	}



	/**
	 * Get request team ID
	 *
	 * @return string Team ID
	 **/
	public function teamId() {

		return !empty($this->input['team_id']) ? $this->input['team_id'] : null;

	}



	/**
	 * Get request text
	 *
	 * @return string Text
	 **/
	public function text() {

		return !empty($this->input['text']) ? $this->input['text'] : null;

	}



	/**
	 * Get request token
	 *
	 * @return string Token
	 **/
	public function token() {

		return !empty($this->input['token']) ? $this->input['token'] : null;

	}



	/**
	 * Get request user ID
	 *
	 * @return string User ID
	 **/
	public function userId() {

		return !empty($this->input['user_id']) ? $this->input['user_id'] : null;

	}



	/**
	 * Get request user name
	 *
	 * @return string User name
	 **/
	public function userName() {

		return !empty($this->input['user_name']) ? $this->input['user_name'] : null;

	}



}
