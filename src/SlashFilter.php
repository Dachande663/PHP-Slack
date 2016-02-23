<?php

namespace HybridLogic\Slack;

/**
 * Slash Filter
 *
 * @package HybridLogic\Slack
 * @author Luke Lanchester
 **/
class SlashFilter {


	/**
	 * @var array Allowed channel IDs
	 **/
	protected $channel_ids = [];


	/**
	 * @var array Allowed team IDs
	 **/
	protected $team_ids = [];


	/**
	 * @var array Allowed user IDs
	 **/
	protected $user_ids = [];


	/**
	 * @var string Error message
	 **/
	protected $error_msg = ":lock: Sorry, I can't let you perform that command.";


	/**
	 * Set allowed channels
	 *
	 * @param stirng|array Channel IDs
	 * @return self
	 **/
	public function allowedChannelIds($ids) {

		if(!is_array($ids)) {
			$this->channel_ids[$ids] = true;
		} else {
			foreach($ids as $id) {
				$this->channel_ids[$id] = true;
			}
		}

		return $this;

	}



	/**
	 * Set allowed channels
	 *
	 * @param stirng|array Channel IDs
	 * @return self
	 **/
	public function allowedTeamIds($ids) {

		if(!is_array($ids)) {
			$this->team_ids[$ids] = true;
		} else {
			foreach($ids as $id) {
				$this->team_ids[$id] = true;
			}
		}

		return $this;

	}



	/**
	 * Set allowed channels
	 *
	 * @param stirng|array Channel IDs
	 * @return self
	 **/
	public function allowedUserIds($ids) {

		if(!is_array($ids)) {
			$this->user_ids[$ids] = true;
		} else {
			foreach($ids as $id) {
				$this->user_ids[$id] = true;
			}
		}

		return $this;

	}



	/**
	 * Check a request is allowed
	 *
	 * @param HybridLogic\Slack\SlashRequest
	 * @return bool True if allowed
	 **/
	public function checkResponse(SlashRequest $request) {

		if($this->check($request) === true) {
			return null;
		}

		return new SlackResponse($this->error_msg);

	}



	/**
	 * Check a request is allowed
	 *
	 * @param HybridLogic\Slack\SlashRequest
	 * @return bool True if allowed
	 * @todo when 5.6 is in LTS, use constant-time string comparison
	 **/
	public function check(SlashRequest $request) {

		if(!empty($this->channel_ids)) {
			$id = $request->channelId();
			if(empty($id) or empty($this->channel_ids[$id])) {
				return false;
			}
		}

		if(!empty($this->team_ids)) {
			$id = $request->teamId();
			if(empty($id) or empty($this->team_ids[$id])) {
				return false;
			}
		}

		if(!empty($this->user_ids)) {
			$id = $request->userId();
			if(empty($id) or empty($this->user_ids[$id])) {
				return false;
			}
		}

		return true;

	}



}
