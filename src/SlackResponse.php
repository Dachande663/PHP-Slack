<?php

namespace HybridLogic\Slack;

/**
 * Slash Response
 *
 * @package HybridLogic\Slack
 * @author Luke Lanchester
 **/
class SlackResponse {


	/**
	 * @const Ephemeral response type
	 **/
	const TYPE_EPHEMERAL = 'ephemeral';


	/**
	 * @const In channel response type
	 **/
	const TYPE_IN_CHANNEL = 'in_channel';


	/**
	 * @var array Data to output
	 **/
	protected $data = [
		'response_type' => 'ephemeral',
		'text'          => '',
		'attachments'   => [],
	];


	/**
	 * Constructor
	 *
	 * @param array|string Data or text
	 * @return void
	 **/
	public function __construct($input = null) {

		if($input !== null) {
			if(is_array($input)) {
				$this->data($input);
			} else {
				$this->text($input);
			}
		}

	}



	/**
	 * Add multiple attachments
	 *
	 * @param array Attachments
	 * @return self
	 **/
	public function addAttachments(array $attachments) {

		if(!array_key_exists('attachments', $this->data) or !is_array($this->data['attachments'])) {
			$this->data['attachments'] = [];
		}

		foreach($attachments as $attachment) {
			if(is_array($attachment)) {
				$this->data['attachments'][] = $attachment;
			}
		}

		return $this;

	}



	/**
	 * Add an attachment
	 *
	 * @param array Attachment
	 * @return self
	 **/
	public function addAttachment(array $attachment) {

		if(!array_key_exists('attachments', $this->data) or !is_array($this->data['attachments'])) {
			$this->data['attachments'] = [];
		}

		$this->data['attachments'][] = $attachment;

		return $this;

	}



	/**
	 * Set data
	 *
	 * @param array Data
	 * @param bool If true, merge data, else overwrite
	 * @return self
	 **/
	public function data(array $data, $merge = false) {

		$this->data = ($merge === true) ? array_merge($this->data, $data) : $data;

		return $this;

	}



	/**
	 * Set response type to ephemeral
	 *
	 * @return self
	 **/
	public function isPrivate() {

		$this->data['response_type'] = static::TYPE_EPHEMERAL;

		return $this;

	}



	/**
	 * Set response type to in_channel
	 *
	 * @return self
	 **/
	public function isPublic() {

		$this->data['response_type'] = static::TYPE_IN_CHANNEL;

		return $this;

	}



	/**
	 * Set response type
	 *
	 * @param string Response type
	 * @return self
	 **/
	public function responseType($type) {

		switch(strtolower($type)) {

			case static::TYPE_EPHEMERAL:
				$this->data['response_type'] = static::TYPE_EPHEMERAL;
				break;

			case static::TYPE_IN_CHANNEL:
				$this->data['response_type'] = static::TYPE_IN_CHANNEL;
				break;

		}

		return $this;

	}



	/**
	 * Set text
	 *
	 * @param string Text
	 * @return self
	 **/
	public function text($text) {

		$this->data['text'] = trim($text);

		return $this;

	}



	/**
	 * Return the current response data
	 *
	 * @return array Data
	 **/
	public function getData() {

		return $this->data;

	}



	/**
	 * Serve response
	 *
	 * @return self
	 **/
	public function serve() {

		if(!headers_sent()) {
			header('Content-Type: application/json');
		}

		echo json_encode($this->data);

		return $this;

	}



	/**
	 * Serve a response but let script execution continue
	 *
	 * @return self
	 **/
	public function serveAndResume() {

		ignore_user_abort(true);
		ob_start();

		$this->serve();
		header('Connection: close');
		header('Content-Length: ' . ob_get_length());

		ob_end_flush();
		ob_flush();
		flush();

		return $this;

	}



	/**
	 * Serve a response to a given URL as JSON POST
	 *
	 * @param string Response URL
	 * @return self
	 **/
	public function serveToUrl($url) {

		$ch = curl_init($url);

		curl_setopt_array($ch, array(
			CURLOPT_POST       => true,
			CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
			CURLOPT_POSTFIELDS => json_encode($this->data),
		));

		curl_exec($ch);

		return $this;

	}



	/**
	 * Get final output
	 *
	 * @return string Output
	 **/
	public function __toString() {

		return json_encode($this->data);

	}



}
